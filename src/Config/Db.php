<?php
namespace App\Config;
use \PDO;

class Db {
    
    public function __construct()
    {}
    
    public function connect() 
    {
        try {
            return new PDO("mysql:host=localhost;dbname=tp", "root", "Namass@20");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}