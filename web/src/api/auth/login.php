<?php
    require("allowCors.php");
    require("./auth_utils.php");
    require("../controller/api.php");
    require_once("../controller/connection.php");

    // $sessHandler = new sessionHandler($conn);

    $jsonText = file_get_contents('php://input');
    $json = json_decode($jsonText);

    $query = $conn->query("SELECT password, userid FROM users WHERE username = '{$json->username}'");
    $data = $query->fetch_assoc();

    // echo $json->password."\n\n";
    // echo $data["password"]."\n".hash('sha256', $json->password)."\n";
    

    if($data["password"] === hash('sha256', $json->password)){
        $userid = $data["userid"];
        $query = $conn->query("SELECT username, color, userid FROM users WHERE userid = '{$userid}'");
        $usersData = $query->fetch_assoc();
        $jsonData = json_encode($usersData);
        echo '{"status":"success", "userdata":'.$jsonData.'}';
    }else{
        echo '{"status":"failed"}';
    }


?>