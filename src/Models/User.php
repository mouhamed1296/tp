<?php
namespace App\Models;

require __DIR__."/../../vendor/autoload.php";

class User{
    
    public function __construct(private string $matricule, private string $lastname, private string $firstname, 
    private string $mail, private string $role, private string $photo, private int $state)
    {}

    public function getMatricule(): string {
        return $this->matricule;
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

    public function getPhoto(): string {
        return $this->photo;
    }

    public function getState(): int {
        return $this->state;
    }
}