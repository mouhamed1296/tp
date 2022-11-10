<?php
namespace App\Controllers;
session_start();

use App\Models\User;
use App\Repositories\UserRepository;
use App\Utils\Validator;

class AddUserController
{
    public function form($params)
    {
        if (isset($params['non'])) {
            session_unset();
            session_destroy();
        }
        if (isset($params['oui'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['fullname'] = $_SESSION['prenom']. ' '. $_SESSION['nom'];
            if ($_SESSION['role'] === "Admin") {
                header("location: user");
                exit;
            }
            if ($_SESSION['role'] === "User") {
                header("location: admin");
                exit;
            }
        }
        require_once __DIR__.'/../Views/inscription.phtml';
    }

    public function signup($params)
    {
        $nom = htmlentities(trim($params['first-name']));
        $prenom = htmlentities(trim($params['last-name']));
        $email = htmlentities(trim($params['email']));
        $role = htmlentities(trim($params['role']));
        $password = htmlentities(trim($params['password']));
        $photo = $params['photo'];
        /* var_dump($photo);
        exit; */
        $photoData = null;
        $userRepo = new UserRepository();
        $dbUser = $userRepo->getUserByEmail($email);
        $generated = "MU2022/".$userRepo->generateMatricule();
        $this->setSession($nom, $prenom, $email, $role, $password, $generated);
        $validator = new Validator();
        if (!$validator->validateEmail($email)) {
            $error = "Adresse email incorrect";
            $this->showError($error);
        }
        if ($dbUser){
            $error = "Adresse email déja pris";
            $this->showError($error);
        }
        if ($photo['error'] === 0) {
            if ($photo['type'] !== "image/jpeg" && $photo['type'] !== "image/jpg" && $photo['type'] !== "image/png"){
                $error = "Format non autorisé seul jpg, jpeg, ou png sont autorisé";
                $this->showError($error);
            }
            if($photo["error"] !== 0 && $photo["size"] > 1000000){
                $error = "Taille photo supérieur à 1MB ou fichier invalide";
                $this->showError($error);
            }
            $photoData = file_get_contents($photo["tmp_name"]);
        }
        $_SESSION['photo'] = $photoData;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $isAdmin = (strtolower($role) === "admin") ? 1 : 0;

        $user = new User($generated, $nom, $prenom, $email, $role, $photoData, $hashedPassword, isAdmin:$isAdmin);
        $res = $userRepo->addUser($user);
        if ($res === 1) {
            $this->showSuccess();
        }
        
    }
    private function showError(string $err){
        $error = "<p class='p-2 bg-red-200 text-red-700 text-center font-bold mb-2' id='server-error'>
        ".$err."
        </p>";
        require_once __DIR__.'/../Views/inscription.phtml';
        exit;
    }

    private function showSuccess(){
        $error = '
        <div id="popup-modal" tabindex="-1" data-modal-show="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <i class="fa-regular fa-circle-ckeck fa-2x text-emerald-600"></i>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Voulez vous vous connecter?</h3>
                    <div class="flex justify-between">
                        <a href="inscription?oui">
                        <button data-modal-toggle="popup-modal" type="button" class="text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Oui</button>
                        </a>
                        <a href="inscription?non">
                            <button data-modal-toggle="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                Non
                            </button>
                        </a>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>';
        require_once __DIR__.'/../Views/inscription.phtml';
        exit;
    }

    private function setSession(string $nom, string $prenom, string $email, string $role, string $password, $matricule = "") 
    {
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;
        $_SESSION['password'] = $password;
        $_SESSION['matricule'] = $matricule;
    }
}