<?php
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Allow-Credentials: true');
    // header('Access-Control-Max-Age: 1728000');
    // header('Content-Length: 0');
    // header('Content-Type: text/plain');
    // if(!isset($_COOKIE["PHPSESSID"])) header("Location: /index.php");
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
    $userID = hash('sha256', $username.$password);
    

    // auth process:
        // check if user exist
            if(checkIfUserExist($conn, $username, $userID)){
                echo "user already exist";
                returnStatus("failed");
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
                    '{$userID}',
                    '0'
                )");

            echo $_COOKIE["PHPSESSID"];
        // create new entry in session
            // $sesHandler = new authHandler($conn);
            // $sessionHandler->addSessionToDB($_COOKIE["PHPSESSION"], $userid);
            // returnStatus("success");
    
    
?>