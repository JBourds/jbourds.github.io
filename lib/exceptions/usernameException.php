<?php
include '../constants.php';

class usernameException extends Exception {
    
    public function __construct($throwCode) {
        $message = null;
        switch($throwCode) {
            case THROW_DUPLICATE_USERNAME:
                $message = 'Username already exists. Select another username.';
                throw new Exception($message, THROW_DUPLICATE_USERNAME, null);
                break;
            case THROW_ALPHA_NUM:
                $message = 'Username contains non-alpha-numeric characters. Select another username.';
                throw new Exception($message, THROW_ALPHA_NUM, null);
                break;
            case THROW_SIZE:
                $message = 'Username must be 8 or more characters.';
                throw new Exception($message, THROW_SIZE, null);
                break;
            default:
                break;
        }

    }
}
