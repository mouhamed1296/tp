<?php
namespace App\Models;

require __DIR__."/../../vendor/autoload.php";

class User{
    
    public function __construct(private string $matricule, private string $lastname, private string $firstname, 
    private string $mail, private string $role, private $photo, private string $password, private int $state = 1, private int $isAdmin = 0, private string | null $date_archive=null,private string | null $date_ins=null)
    {}

    public function getMatricule(): string {
        return $this->matricule;
    }

    public function getNom(): string {
        return $this->lastname;
    }

    public function getPrenom(): string {
        return $this->firstname;
    }

    public function getName(): string {
        return $this->firstname.' '.$this->lastname;
    }

    public function getMail(): string {
        return $this->mail;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getState(): int {
        return $this->state;
    }

    public function getPassword(): string {
        return $this->password;
    }
    public function getIsAdmin(): int {
        return $this->isAdmin;
    }
    public function getDateArchive():string {
        return $this->date_archive;
    }
    public function getDateIns():string {
        return $this->date_ins;
    }
}