<?php
namespace App\Repositories;
require_once __DIR__."/../../vendor/autoload.php";

use App\Config\Db;
use App\Models\User;

class UserRepository {
    private $databaseConnection;
    
    public function __construct()
    {
        $database = new Db();
        $this->databaseConnection = $database->connect();
    }

    public function addUser(User $user){

    }

    public function updateUser(string $matricule){

    }

    public function draftUser(string $matricule){

    }

    public function getUndraftedUsers(){

    }

    public function getDraftedUsers(){

    }

    public function searchUser(string $matricule){
        
    }

    public function getUserByEmail(string $email): User
    {
        $sql = "SELECT * from user WHERE mail='$email'";
        $res = $this->databaseConnection->query($sql);
        return $res->fetchObject(User::class);

    }
}