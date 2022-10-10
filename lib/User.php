<?php
/**
 * This class represents a user account in the database and contains all methods pertaining to a user
 */
require_once('constants.php');
include 'DataBase.php';
include 'helperFunctions.php';
include 'exceptions/usernameException.php';
include 'exceptions/passwordException.php';
include 'exceptions/userCreationException.php';

const USER_DEBUG = false;

class User {
    // Initialize user variables and create account
    public function __construct($username, $password, $name, $email, $phoneNumber) {
        $this->username = $username;
        $this->password = $password;
        $this->hashedPassword = password_hash($password, PASSWORD_ARGON2ID); 
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->database = new DataBase('jbourde2_writer', DATABASE_NAME);
        $this->userID = null;
        $this->permissions = 'none';
    }

    // Creating new user
    public function makeUserAccount() {
        if ($this->verifyUserFields()) {
            return $this->createUser();
        }
    }

    // Returns true if user fields both are valid
    private function verifyUserFields() {
        try {
            if ($this->verifyUsername()) {
                if ($this->verifyPassword()) {
                    return true;
                }
            }
        }
        catch (Exception $e) {
            print '<p class="mistake">Error: ' . $e->getMessage() . PHP_EOL;   
        }
        return false;
    }

    // Returns false if username/password isn't valid, true otherwise.
    private function verifyUsername() {

        if ($this->verifyNonDuplicateUsername()
            && verifyLoginField($this->username) 
            && strlen($this->username) >= 8) {
            return true;
        } elseif (!$this->verifyNonDuplicateUsername()) {
            throw new usernameException(THROW_DUPLICATE_USERNAME);
        } elseif (!verifyAlphaNum($this->username)) {
            throw new usernameException(THROW_ALPHA_NUM);
        } elseif (!strlen($this->username) >= 8) {
            throw new usernameException(THROW_SIZE);
        }
    }

    private function verifyNonDuplicateUsername() {
        $sql = 'SELECT * FROM ' . ACCOUNTS_TABLE . ' WHERE fldUsername = ?';
        $records = $this->database->select($sql, array($this->username));
        if (USER_DEBUG) {
            $displaySQL = $this->database->displaySQL($sql, array($this->username));
            print $displaySQL . PHP_EOL;
            print '<p>Records Returned:</p>';
            foreach ($records as $record) {
                print 'User ID: ' . $record['pmkUserID'] . PHP_EOL;
            }
            print 'Records Empty: ' . empty($records) . PHP_EOL;
        }
        
        if (empty($records)) {
            return true;
        } else {
            return false;
        }
    }

    private function verifyPassword() {
        verifyLoginField($this->password) ? $alphaNumeric = true : $alphaNumeric = false;
        strlen($this->password) >= 10 ? $correctSize = true : $correctSize = false;

        if ($alphaNumeric && $correctSize) {
            return true;
        } elseif (!$alphaNumeric) {
            throw new passwordException(THROW_ALPHA_NUM);
        } elseif (!$correctSize) {
            throw new passwordException(THROW_SIZE);
        }
    }

    // Creates user
    private function createUser() {
        $success = false;
        $createAccount = $this->createUserAccount();
        $this->userID = $this->database->getLastID();
        $createUserInfo = $this->createUserInfo();
        ($createAccount) ? $createAccount = true : throw new userCreationException(ACCOUNT_NOT_CREATED);
        ($createUserInfo) ? $createUserInfo = true : throw new userCreationException(INFO_NOT_CREATED);
        ($createAccount && $createUserInfo) ? $success = true : $success = false;
        return $success;
    }

    // Creates record in user account table
    private function createUserAccount() {
        $sql = 'INSERT INTO ' . ACCOUNTS_TABLE . ' SET 
        pmkUserID = ?,
        fldUsername = ?,
        fldPassword = ? 
        ON DUPLICATE KEY UPDATE
        fldUsername = ?,
        fldPassword = ?';
        $params = array($this->userID, $this->username, $this->hashedPassword, $this->username, $this->hashedPassword);
        return $this->database->insert($sql, $params);
    }

    // Creates record in user info table
    private function createUserInfo() {
        $sql = 'INSERT INTO ' . INFO_TABLE . ' SET 
        pmkUserID = ?,
        fldName = ?,
        fldEmail = ?,
        fldPhoneNumber = ?,
        fldPermissions = ?
        ON DUPLICATE KEY UPDATE
        fldName = ?,
        fldEmail = ?,
        fldPhoneNumber = ?,
        fldPermissions = ?';
        $params = array($this->userID, $this->name, $this->email, $this->phoneNumber, $this->permissions, $this->name, $this->email, $this->phoneNumber, $this->permissions);
        return $this->database->insert($sql, $params);
    }

    // For use to update user info after it has been created
    public function changeUserInfo() {
        $this->createUserInfo($this->userID, $this->name, $this->email, $this->phoneNumber, $this->permissions);
    }

    public function userExists($username) {
        $sql = 'SELECT * FROM ' . ACCOUNTS_TABLE . ' WHERE
            fldUsername = ?';
        $records = $this->database->select($sql, array($this->username));
        if (!empty($records)) {
            return true;
        }
        return false;
    }

    private function changeUsername($username) {

    }

    private function changePassword($password) {

    }

    // Getters
    
    public function getUserID() {

    }

    public function getUsername() {

    }

    public function getPassword() {

    }

    public function getEmail() {

    }

    public function getPhoneNumber() {

    }

    public function getPermissions() {

    }

    // Setters

    public function setUserID() {

    }

    public function setUsername() {

    }

    public function setPassword() {

    }

    public function setEmail() {

    }

    public function setPhoneNumber() {

    }

    public function setPermissions() {

    }

    
}
