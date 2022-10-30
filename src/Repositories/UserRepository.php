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

    public function addUser(User $user): int {
        $date_ins = date("y-m-d h:i:s");
        $matricule = $user->getMatricule();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $email = $user->getMail();
        $role = $user->getRole();
        $password = $user->getPassword();
        $photo = $user->getPhoto();
        $isAdmin = $user->getIsAdmin();
        $sql = "INSERT INTO user(matricule, nom, prenom, email, `role`, mdp, photo, is_admin, date_ins) 
        VALUES(?,?,?,?,?,?,?,?,?)";
        /*var_dump($sql);
        exit;*/
        $statement = $this->databaseConnection->prepare($sql);
        $statement->bindParam(1, $matricule);
        $statement->bindParam(2, $nom);
        $statement->bindParam(3, $prenom);
        $statement->bindParam(4, $email);
        $statement->bindParam(5, $role);
        $statement->bindParam(6, $password);
        $statement->bindParam(7, $photo);
        $statement->bindParam(8, $isAdmin);
        $statement->bindParam(9, $date_ins);
        $statement->execute();
        if ($this->databaseConnection->lastInsertId()) {
            return 1;
        }
        return 0;
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

    public function generateMatricule(): int
    {
        $sql = "SELECT matricule from user ORDER BY id DESC LIMIT 1";
        $res = $this->databaseConnection->query($sql);
        if($res->rowCount() > 0) {
            $data = (int) explode("/", $res->fetchColumn())[1];
            return $data + 1;
        }
        return 1;
    }

    public function getUserByEmail(string $email): User|null
    {
        $sql = "SELECT * from user WHERE email='$email'";
        $res = $this->databaseConnection->query($sql);
        if ($res->rowCount() > 0) {
            $data = $res->fetchAll();
            return $this->convertArrayToUsers($data)[0];
        }
        return null;
    }

    private function convertArrayToUsers(array $array): array
    {
        $users = [];
        foreach($array as $donne){
            $user = new User($donne['matricule'], $donne['nom'], $donne['prenom'], $donne['email'], $donne['role'], $donne['photo'], $donne['etat']);
            array_push($users, $user);
        }
        return $users;
    }
}