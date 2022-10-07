<?php
include '../constants.php';

class userCreationException extends Exception {

    public function __construct($throwCode) {
        $message = null;
        switch($throwCode) {
            case ACCOUNT_NOT_CREATED:
                $message = 'Error in user account creation.';
                throw new Exception($message, ACCOUNT_NOT_CREATED, null);
                break;
            case INFO_NOT_CREATED:
                $message = 'Error in user info creation.';
                throw new Exception($message, INFO_NOT_CREATED, null);
                break;
            default:
                break;
        }

    }
}
