<?php    
    require("allowCors.php");

    if($_SERVER["REQUEST_METHOD"] !== "POST")die;
    
    require("check.php");
    require(__DIR__."/../controller/api.php");
    require_once("auth_utils.php");
    require_once(__DIR__."/../controller/connection.php");




    $jsonText = file_get_contents('php://input');
    $json = json_decode($jsonText);

    // user datas:
    $username = preg_replace("/[^a-zA-Z\d]/i", "", $json->username);
    $password = hash("sha256", $json->password);
    $color = $json->color;

    // generated datas:
    $displayname = $username;
    $userid = hash('sha256', $username.$password);
    

    // auth process:
        // check if user exist
    if(checkIfUserExist($conn, $username, $userid)){
        echo '{"status":"failed"}';
        die;
    }
        // create new entry in users
    $conn->query("
        INSERT 
        INTO 
            `users`
                (
                    `username`, 
                    `password`, 
                    `creationDate`, 
                    `displayname`, 
                    `color`, 
                    `userid`, 
                    `isBanned`
                ) 
        VALUES (
            '{$username}',
            '{$password}',
            NOW()-1,
            '{$username}',
            '{$color}',
            '{$userid}',
            '0'
        )");
    $query = $conn->query("SELECT username, color, userid FROM users WHERE userid = '{$userid}'");
    $usersData = $query->fetch_assoc();
    $jsonData = json_encode($usersData);
    echo '{"status":"success", "userdata":'.$jsonData.'}';            
                
        // create new entry in session
            // $sesHandler = new authHandler($conn);
            // $sessionHandler->addSessionToDB($_COOKIE["PHPSESSION"], $userid);
            // returnStatus("success");
    
    
?>