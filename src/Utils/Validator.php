<?php

namespace App\Utils;

class Validator
{
    /**
     * Class constructor.
     */
    public function __construct()
    {}
    public function validateEmail(string $email): bool
    {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }
    public function isEmpty(string $var):bool
    {
        return empty($var);
    }
    public function isNull(int | float $var):bool
    {
        return is_int($var) && $var === 0 ? true : is_float($var) && $var = 0.0 ? true : false;
    }
}