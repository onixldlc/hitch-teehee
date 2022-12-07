<?php
    require("internalUtils.php");
    require(__DIR__."/../controller/connection.php");
    
    checkInternal();

    $jsonText = file_get_contents('php://input');
    $json = json_decode($jsonText);

    if(!isset($json->userid)){
        echo '{"status":"error", "reason":"no userid found"}';
        die;
    }
    $userid = $json->userid;

    $query = $conn->query("SELECT count(*) FROM users WHERE userid = '{$userid}'");
    $result = $query->fetch_column();

    if($result){
        echo '{"status":"success"}';
        die;
    }
    echo '{"status":"failed"}';

?>