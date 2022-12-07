<?php
  require_once("config.php");

  $conn = new mysqli(
    $SRV_SQL_HOST,
    $SRV_SQL_USER,
    $SRV_SQL_DBPASS,
    $SRV_SQL_DBNAME
  );
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // echo "Connected successfully";
?>
