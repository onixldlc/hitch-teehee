<?php
    function checkIfUserExist($conn, $username, $userid){
        $result = $conn->query("SELECT count(*) FROM users WHERE username = '{$username}' OR userid = '{$userid}'");
        return $result->fetch_array()[0];
    }
    
?>