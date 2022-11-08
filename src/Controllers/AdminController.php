<?php
namespace App\Controllers;
use App\Repositories\UserRepository;

class AdminController
{
    public function home($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            $userRepository = new UserRepository();
            $users = $userRepository->getUndraftedUsers($_SESSION['email']);
            include_once __DIR__."/../Utils/paginateResults.php";
            $users =  $userRepository->paginateUndrafted($start, $limit, $_SESSION['email']);
            require_once __DIR__.'/../Views/admin.phtml';
        } else {
            header('location: /tp/');
        }
    }

    public function archives($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            $userRepository = new UserRepository();
            $users = $userRepository->getDraftedUsers($_SESSION['email']) ?? [];
            include_once __DIR__."/../Utils/paginateResults.php";
            $users =  $userRepository->paginateDrafted($start, $limit, $_SESSION['email']);
            require_once __DIR__.'/../Views/archives.phtml';
        } else {
            header('location: /tp/');
        }
    }

    public function draftUser($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            $userRepository = new UserRepository();
            $email = $params['email'];
            $userRepository->draftUser($email);
            header('location: admin');
        } else {
            header('location: /tp/');
        }
    }

    public function unDraftUser($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            $userRepository = new UserRepository();
            $email = $params['email'];
            $userRepository->undraftUser($email);
            header('location: admin');
        } else {
            header('location: /tp/');
        }
    }
    public function updateForm($params)
    {

        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            $userRepository = new UserRepository();
            $email = $params['email'];
            $user = $userRepository->getUserByEmail($email);
            require_once __DIR__.'/../Views/updateForm.phtml';
        } else {
            header('location: /tp/');
        }
    }
    public function update($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            $userRepository = new UserRepository();
            $nom = htmlentities(trim($params['first-name']));
            $prenom = htmlentities(trim($params['last-name']));
            $email = htmlentities(trim($params['email']));
            $emailUser = htmlentities(trim($params['email-user']));
            $user = $userRepository->getUserByEmail($emailUser);
            if ($user){
                $userCheck = $userRepository->getUserByEmail($email);
                if ($emailUser !== $email && $userCheck) {
                    header("location: update?email=$emailUser&&error=Adresse e-mail déjà pris");
                    exit;
                }
                $sql = "UPDATE user SET nom='$nom', prenom='$prenom', email='$email' WHERE email='$emailUser'";
                $userRepository->updateUser($sql);
                header('location: admin');
            }
            //var_dump($params);
        } else {
            header('location: /tp/');
        }
    }

    public function switch($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "Admin"){
            $userRepo = new UserRepository();
            $userRepo->changeRole($params['email']);
            $location = "admin";
            /* var_dump($params);
            exit; */
            if(isset($params['page'])) {
                $page = $params['page'];
                $location = "admin?page=$page";
            }
            
            header("location: $location");
        } else {
            header('location: /tp/');
        }
    }
    
}