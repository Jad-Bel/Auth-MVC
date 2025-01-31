<?php

class CsrfToken 
{
    // generate a csrf token, return type is a string
    public static function generate() 
    {
        return bin2hex(random_bytes(32));
    } 

    // store the csrf token in the session, parametre type a string
    public static function store ($token)
    {
        $_SESSION['csrf_token'] = $token;
    }

    // validate the submitted csrf token
    public static function validate ($submittedToken) 
    {
        $sessionToken = $_SESSION['csrf_token'];
        return hash_equals($sessionToken, $submittedToken);
    }
    // get the current csrf token, return type string
    public static function get() 
    {
        return $_SESSION['csrf_token'];
    }

    // regenerate the csrf token with generate method 
    public static function regenerate() 
    {
        $_SESSION['csrf_token'] = self::generate();
    }
}