<?php

$deployed = true;

if ($deployed) {
    $dbServerName = "qbct6vwi8q648mrn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
    $dbUsername = "az7ops07y8zb0lzz";
    $dbPassword = "cvxrk814tkr5s2x2";
    $dbName = "o5b26p64rbcl8s4x";
    $dbPort = "3306";

    $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName, $dbPort);
} else {
    $dbServerName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "loginsystem";

    $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
}