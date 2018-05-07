<?php

// TODO hash password
class User {
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $email;

    function __construct(string $username, string $password, string $firstName, string $lastName, string $email) {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    function __destruct() {
        // TODO 
    }

    // GETTERS
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getFirstName() {
        return $this->firstName;
    }

    function getLastName() {
        return $this->lastName;
    }

    function getEmail() {
        return $this->email;
    }
    
    // SETTERS
    function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    function setEmail($email) {
        $this->email = $email;
    }
}

?>