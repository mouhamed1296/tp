<?php
namespace App\Config;
use \PDO;

class Db {
    
    private function __construct()
    {}
    
    public static function connect()
    {
        try {
            return new PDO("mysql:host=localhost;dbname=tp", "root", "Namass@20");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}