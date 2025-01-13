<?php

class Auth {

    /**
     * 
     * Controls if user is logged in
     * 
     * @return boolean True if user is logged in, False if not
     */
    public static function isLoggedIn() {
        return isset($_SESSION["is_logged_in"]) and $_SESSION["is_logged_in"];
    }
}