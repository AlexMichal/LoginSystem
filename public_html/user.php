<?php
// TODO hash password
class User {
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $email;

    function __construct($username, $password, $firstName, $lastName, $email) {
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
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getEmail() {
        return $this->email;
    }
    
    // SETTERS
    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    // DB! DB! DB!
    public function saveUserToDB($conn) {
        $sql =  "INSERT INTO users(user_first_name, user_last_name, user_email, user_username, user_password) " .
                "VALUES ('$this->firstName', '$this->lastName', '$this->email', '$this->username', '$this->password');";

        mysqli_query($conn, $sql); // Insert data into the database
    }

    public function getUserFromDB($conn) {
        $sql = "SELECT * FROM users WHERE user_username = '$this->username'";
        $result = mysqli_query($conn, $sql);
    
        return $result;
    }

    public function checkIfUserExistsInDB($conn) {
        $queryResult = $this->getUserFromDB($conn);
    
        if (mysqli_num_rows($queryResult) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>