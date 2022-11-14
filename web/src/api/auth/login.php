<?php
    if(!isset($_COOKIE["php"])) header("Location: index.php");

    require("./auth_utils.php");
    require("../controller/api.php");
    require_once("../controller/connection.php");

    // $sessHandler = new sessionHandler($conn);

    $jsonText = file_get_contents('php://input');
    $json = json_decode($jsonText);

    $userhash = hash('sha256', $json->username);
    $result = $conn->query("SELECT password, userid FROM users WHERE userhash = {$userhash}");
    $password = $result->fetch_all();

    echo var_dump($password)

    // if($password === hash('sha256', $json->password)){
    //     $userID = 
    // }


?>