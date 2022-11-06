<?php
namespace App\Controllers;
session_start();

use App\Repositories\UserRepository;

require_once __DIR__."/../../vendor/autoload.php";

class AuthController
{
    public function form()
    {
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "User"){
            header("location: user");
            exit;
        }
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            header("location: admin");
            exit;
        }
        require_once __DIR__.'/../Views/connexion.phtml';
    }

    public function authenticate($params)
    {
       $email = htmlentities($params['mail']);
       $password = htmlentities($params['password']);
       $userRepo = new UserRepository();
       $user = $userRepo->getUserByEmail($email);
       //var_dump($email);
       //var_dump($password);
       $_SESSION['email'] = $email;
       $_SESSION['password'] = $password;
       if ($user === null) {
        $this->setError("Adresse email incorrect");
       }
       if ($user->getState() === 0) {
        $this->setError("Votre compte a été archivé veuillez contacter l'admin<br> pour pouvoir utiliser votre compte à nouveau.");
       }
       if(!password_verify($password, $user->getPassword())) {
        $this->setError("Mot de passe incorrect");
       }
       $role = $user->getRole();
       $_SESSION['photo'] = $user->getPhoto();
       $_SESSION['role'] = $role;
       $_SESSION['fullname'] = $user->getName();
       $_SESSION['email'] = $user->getMail();
       $_SESSION['matricule'] = $user->getMatricule();
       $_SESSION['loggedIn'] = true;
       if ($role === "Admin"){
       header("location: admin");
       }
       if ($role === "User"){
        header("location: user");
       }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("location: /tp/");
    }

    private function setError(string $err)
    {
        $error = "<p class='p-2 bg-red-200 text-red-700 text-center font-bold mb-2'>
        $err
        </p>";
        require_once __DIR__.'/../Views/connexion.phtml';
    }
}