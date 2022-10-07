<?php
include 'constants.php';
include 'helperFunctions.php';
include 'DataBase.php';

const LOGIN_DEBUG = false;

class Login {

    public function __construct($username, $password) {
        $this->success = false;
        $this->database = new DataBase('jbourde2_writer', DATABASE_NAME);
        $this->username = $username;
        $this->unhashedPassword = $password;
        $this->hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
        if (LOGIN_DEBUG) {
            print '<p>Username: ' . $this->username . '</p>' . PHP_EOL;
            print '<p>Password: ' . $this->unhashedPassword . '</p>' . PHP_EOL;
            print '<p>Hashed Password: ' . $this->hashedPassword . '</p>' . PHP_EOL;
        }
        if ($this->userAccountExists()) {
            $this->success = true;
        }
    }

    public function userAccountExists() {
        $sql = 'SELECT fldPassword FROM ' . ACCOUNTS_TABLE . ' WHERE 
        fldUsername = ?';
        $records = $this->database->select($sql, array($this->username));
        if (!empty($records)) {
            if (password_verify($this->unhashedPassword, $records[0]['fldPassword'])) {
                return true;
            }
            
        }
        return false;
    }

    public function getSuccess() {
        return $this->success;
    }
}

?>