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
       $user = $userRepo->getUserByEmail($email);
       //var_dump($email);
       //var_dump($password);
       if ($user === null) {
        $error = "<p class='p-2 bg-red-200 text-red-700 text-center font-bold mb-2'>
        Email ou mot de passe incorrect
        </p>";
        require_once __DIR__.'/../Views/connexion.phtml';
       }
       if(!password_verify($password, $user->getPassword()))
       if ($user->getRole() === "admin"){
        require_once __DIR__.'/../Views/admin.phtml';
       }
    }
}