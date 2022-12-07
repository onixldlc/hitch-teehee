<?php
    function checkIfUserExist(mysqli $conn, $username, $userid){
        $result = $conn->query("SELECT count(*) FROM users WHERE username = '{$username}' OR userid = '{$userid}'");
        $data = $result->fetch_column();
        return $data;
    }
    
?>