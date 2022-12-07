<?php
    require("controller/api.php");
    require_once("controller/connection.php");

    $jsonText = file_get_contents('php://input');
    $json = json_decode($jsonText);

    $message = [];

    $query = $conn->query("SELECT * FROM messages WHERE thread = '{$json->thread}'");
    $result = $query->fetch_array();

?>