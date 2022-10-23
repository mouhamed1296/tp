<?php
require_once "../config/Db.php";
require_once "../models/User.php";

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
}