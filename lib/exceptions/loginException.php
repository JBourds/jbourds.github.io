<?php
include '../constants.php';

class loginException extends Exception {
    
    public function __construct($throwCode) {
        $message = null;
        switch($throwCode) {

            default:
                break;
        }

    }
}


?>