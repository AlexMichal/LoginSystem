<?php

class Message {
    private $message;
    private $timestamp;
    private $userId;

    function __construct($message, $timestamp, $userId) {
        $this->message = $message;
        $this->timestamp = $timestamp;
        $this->userId = $userId;
    }

    function __destruct() {
        // TODO 
    }

    // GETTERS
    function getMessage() {
        return $this->message;
    }

    function getTimestamp() {
        return $this->timestamp;
    }

    function getUserId() {
        return $this->user_id;
    }
    
    // SETTERS
    function setMessage($message) {
        $this->message = $message;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }
}

?>