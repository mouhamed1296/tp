<?php
namespace App\Controllers;

use App\Repositories\UserRepository;

require_once __DIR__."/../../vendor/autoload.php";

class AuthController
{
    public function form()
    {
        require_once __DIR__.'/../Views/connexion.phtml';
    }

    public function authenticate($params)
    {
       $email = htmlentities($params['mail']);
       $password = htmlentities($params['password']);
       $userRepo = new UserRepository();
       //$user = $userRepo->getUserByEmail($email);
       var_dump($email);
       var_dump($password);
       //var_dump($user->getMail());
    }
}