<?php

require_once("../Database/functions.php");
require_once("../Database/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    response("Only POST method accepted!");
}

if (!isset($_POST["token"])) {
    response("Token is required!");
}

$token=$_POST["token"];




$pdo = getPDO();



$query = "SELECT * FROM users where token = :token ";
$stmt = $pdo->prepare($query);
$stmt->bindParam("token", $token);

$stmt->execute();


$user = $stmt->fetch(PDO::FETCH_ASSOC);

$key= $user["ddocode"];


$query = "SELECT * FROM employee_details where ddocode = :key ";
$stmt = $pdo->prepare($query);
$stmt->bindParam("key", $key);

$stmt->execute();



$employee = $stmt->fetchAll(PDO::FETCH_ASSOC);
response(true,"sucessfull",$employee);