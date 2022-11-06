<?php
namespace App\Repositories;
require_once __DIR__."/../../vendor/autoload.php";

use App\Config\Db;
use App\Models\User;

class UserRepository {
    private $databaseConnection;
    
    public function __construct()
    {
        $this->databaseConnection = Db::connect();
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

    public function updateProfilePhoto(string $email, $photoData): bool {
        $sql = "UPDATE user SET photo=? WHERE email=?";
        $statement = $this->databaseConnection->prepare($sql);
        $statement->bindParam(1, $photoData);
        $statement->bindParam(2, $email);
        return $statement->execute();
    }

    public function updateUser(string $sql){
        $this->databaseConnection->exec($sql);
    }

    public function draftUser(string $email){
        $date_archive = date('y-m-d');
        $sql = "UPDATE user SET etat=0, date_archive='$date_archive', date_desarchive=null WHERE email='$email'";
        $this->databaseConnection->exec($sql);
    }

    public function unDraftUser(string $email){
        $date_desarchive = date('y-m-d');
        $sql = "UPDATE user SET etat=1, date_archive=null, date_desarchive='$date_desarchive' WHERE email='$email'";
        $this->databaseConnection->exec($sql);
    }

    public function changeRole($email)
    {
        $user = $this->getUserByEmail($email);
        $newRole = $user->getIsAdmin() === 1 ? "User" : "Admin";
        $isAdmin = $user->getIsAdmin() === 1 ? 0 : 1; 
        $sql = "UPDATE user SET `role`='$newRole', is_admin=$isAdmin WHERE email='$email'";
        $this->databaseConnection->exec($sql);
    }

    public function getUndraftedUsers(string $email): array | null
    {
        $sql = "SELECT * from user WHERE etat=1 and email != '$email'";
        return $this->runSelectionRequest($sql);
    }

    public function getDraftedUsers(string $email): array | null
    {
        $sql = "SELECT * from user WHERE etat=0 and email != '$email'";
        return $this->runSelectionRequest($sql);
    }

    public function searchUndraftedUsers(string $searchTerm, $email): array | null
    {
        $sql = "SELECT * FROM user where etat=1 and email != '$email'
        and (nom like '%$searchTerm%' or prenom like  '%$searchTerm%'
         or email like '%$searchTerm%' or matricule like '%$searchTerm%')  
        ORDER BY id ASC";

        return $this->runSelectionRequest($sql);

    }

    public function searchDraftedUsers(string $searchTerm, string $email){
        $sql = "SELECT * FROM user where etat=0 and email != '$email'
        and (nom like '%$searchTerm%' or prenom like  '%$searchTerm%'
         or email like '%$searchTerm%' or matricule like '%$searchTerm%') 
        ORDER BY id ASC";
          
          return $this->runSelectionRequest($sql);

    }

    public function paginateSearchUndrafted(string $searchTerm, int $start, int $offset, string $email) {
        $sql = "SELECT * FROM user where etat=1 and email != '$email'
        and (nom like '%$searchTerm%' or prenom like  '%$searchTerm%'
         or email like '%$searchTerm%' or matricule like '%$searchTerm%')  
        ORDER BY id ASC LIMIT $start, $offset";

        return $this->runSelectionRequest($sql);
    }
    public function paginateSearchDrafted(string $searchTerm, int $start, int $offset, string $email) {
        $sql = "SELECT * FROM user where etat=0 and email != '$email'
        and (nom like '%$searchTerm%' or prenom like  '%$searchTerm%'
         or email like '%$searchTerm%' or matricule like '%$searchTerm%') 
        ORDER BY id ASC LIMIT $start, $offset";
          
          return $this->runSelectionRequest($sql);
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
        return $this->runSelectionRequest($sql)[0] ?? null;
    }

    private function convertArrayToUsers(array $array): array
    {
        $users = [];
        foreach($array as $donne){
            $user = new User($donne['matricule'], $donne['nom'], $donne['prenom'], $donne['email'], $donne['role'], $donne['photo'], $donne['mdp'], $donne['etat'], $donne['is_admin'], $donne['date_archive'], $donne['date_ins']);
            array_push($users, $user);
        }
        return $users;
    }

    private function runSelectionRequest($sql): array | null
    {
        $res = $this->databaseConnection->query($sql);
        if ($res->rowCount() > 0) {
            $data = $res->fetchAll();
            return $this->convertArrayToUsers($data);
        }
        return null;
    }

    public function paginateUndrafted(int $start, int $offset, string $email) {
        $sql = "SELECT * from user WHERE etat=1 and email!='$email' LIMIT $start, $offset";
        return $this->runSelectionRequest($sql);
    }
    public function paginateDrafted(int $start, int $offset, string $email) {
        $sql = "SELECT * from user WHERE etat=0 and email!='$email' LIMIT $start, $offset";
        return $this->runSelectionRequest($sql);
    }
}