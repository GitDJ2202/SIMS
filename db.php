<?php
error_reporting(0);
	$dbUser="username";
	$dbPass="password";
	$HostServer="localhost";
	$dbName="sims";

	$Tables = array(
        "CREATE TABLE IF NOT EXISTS userLogin (
        id VARCHAR(20) PRIMARY KEY,
        pword VARCHAR(32),
        userRole VARCHAR(40),
        status VARCHAR(10)
    )",

        "CREATE TABLE IF NOT EXISTS users (
        id VARCHAR(20) PRIMARY KEY,
        Fname VARCHAR(30),
        Lname VARCHAR(30),
        DOB DATE,
        gender CHAR(1)
    )",
    
        "CREATE TABLE IF NOT EXISTS contact(
        id VARCHAR(20) PRIMARY KEY,
        phoneNo VARCHAR(14),
        email VARCHAR(30),
        address VARCHAR(200),
        postcode VARCHAR(12),
        city VARCHAR(20),
        state VARCHAR(20),
        country VARCHAR(20)
    )",

        "CREATE TABLE IF NOT EXISTS supplier(
        id VARCHAR(20) PRIMARY KEY,
        name VARCHAR(30),
        pointOfContact VARCHAR(30)
    )",

        "CREATE TABLE IF NOT EXISTS stockIn(
        id INT(20) PRIMARY KEY AUTO_INCREMENT,
        itemId VARCHAR(20),
        quantity INT(10),
        receivedBy VARCHAR(20),
        date DATE
    )",

        "CREATE TABLE IF NOT EXISTS stockOut(
        id INT(20) PRIMARY KEY AUTO_INCREMENT,
        itemId VARCHAR(20),
        stockOutCatId INT(10),
        description VARCHAR(200),
        usedQuantity INT(10),
        usedBy VARCHAR(20),
        date DATE
    )",

        "CREATE TABLE IF NOT EXISTS masterStockRecord(
        id INT(20) PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(30),
        categoryId INT(10),
        totalQuantity INT(10),
        usedQuantity INT(10),
        currentQuantity INT(10),
        locationId INT(10),
        supplierName VARCHAR(30)
    )",

        "CREATE TABLE IF NOT EXISTS stockOutCat(
        id INT(10) PRIMARY KEY AUTO_INCREMENT,
        categoryDetail VARCHAR(30),
        status VARCHAR(10)
    )",

        "CREATE TABLE IF NOT EXISTS itemCat(
        id INT(10) PRIMARY KEY AUTO_INCREMENT,
        categoryDetail VARCHAR(30),
        status VARCHAR(10)
    )",

        "CREATE TABLE IF NOT EXISTS stockLocation(
        id INT(10) PRIMARY KEY AUTO_INCREMENT,
        locationName VARCHAR(30),
        status VARCHAR(10)
    )"
);


$con = new mysqli($HostServer, $dbUser, $dbPass);

if ($con->connect_errno) {
    echo "Connect Failed: " . $con->connect_error;
    exit();
}

$query = "CREATE DATABASE IF NOT EXISTS " . $dbName;
$con->query($query);
$con->select_db($dbName);

for ($i = 0; $i < count($Tables); $i++) {
    //echo $Tables[$i]."<br>";
    $con->query($Tables[$i]);
}

?>
