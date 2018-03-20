<?php

$deployed = true;

if (deployed) {
    $dbServername = "mysql://az7ops07y8zb0lzz:cvxrk814tkr5s2x2@qbct6vwi8q648mrn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/o5b26p64rbcl8s4x";
    $dbusername = "az7ops07y8zb0lzz";
    $dbPassword = "cvxrk814tkr5s2x2";
    $dbName = "loginsystemphp";
} else {
    $dbServername = "localhost";
    $dbusername = "root";
    $dbPassword = "";
    $dbName = "loginsystem";
}

$conn = mysqli_connect($dbServername, $dbusername, $dbPassword, $dbName);