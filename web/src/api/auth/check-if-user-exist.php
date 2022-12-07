<?php
    require("allowCors.php");
    require(__DIR__."/../controller/api.php");
    require(__DIR__."/../controller/connection.php");
    require("check.php");

    $jsonText = file_get_contents('php://input');
    $json = json_decode($jsonText);

    $username = $json->username;
    $userID = "0";
    if(isset($json->userid)){
        $userID = $json->userid;
    }

    if(!checkIfUserExist($conn, $username, $userID)){
        echo '{"status":"success"}';
        die;
    }
    echo '{"status":"failed"}'
?>