<?php


  require_once("config.php");
  echo "<pre>
  $SRV_SQL_HOST,
  $SRV_SQL_USER,
  $SRV_SQL_DBPASS,
  $SRV_SQL_DBNAME</pre>";

  $conn = new mysqli(
    $SRV_SQL_HOST,
    $SRV_SQL_USER,
    $SRV_SQL_DBPASS,
    $SRV_SQL_DBNAME
  );
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";




  // class dbHandler{
  //   public $conn;
    
  //   public function __construct(){

  //   }

  //   public function get(string $queryString){
  //     $result = $this->conn->query($queryString);
  //     return $result->fetch_array();
  //   }

  //   public function add(string $table, string $values){
  //     $this->conn->query("INSERT INTO {$table}");
  //   }
  // }

  // $mydb=new dbHandler();

?>
