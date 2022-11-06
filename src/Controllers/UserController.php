<?php
namespace App\Controllers;
use App\Repositories\UserRepository;

class UserController
{
    public function home($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "User"){
            $userRepository = new UserRepository();
            $users = $userRepository->getUndraftedUsers($_SESSION['email']) ?? [];
            include_once __DIR__."/../Utils/paginateResults.php";
            $users =  $userRepository->paginateUndrafted($start, $limit, $_SESSION['email']);
            require_once __DIR__.'/../Views/user.phtml';
        } else {
            header('location: /tp/');
        }
    }

    public function archives($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['role'] === "User"){
            $userRepository = new UserRepository();
            $users = $userRepository->getDraftedUsers($_SESSION['email']) ?? [];
            include_once __DIR__."/../Utils/paginateResults.php";
            $users =  $userRepository->paginateDrafted($start, $limit, $_SESSION['email']) ?? [];
            require_once __DIR__.'/../Views/userArchives.phtml';
        } else {
            header('location: /tp/');
        }
    }
}