<?php
    class dbHandler{
        public mysqli $connection;

        public function __construct(mysqli $conn) {
            $this->connection = $conn;
        }
    }

    class authHandler extends dbHandler{
        public function addUser(string $username, string $password, string $color, $userID){
            $this->conn->query("
                INSERT INTO 
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
                    NOW(),
                    '{$username}',
                    '{$color}',
                    '{$userID}',
                    '0'
                )"
            );
        }
    }

    function returnStatus(string $status){
        $status = `{
            "status":"{$status}"
        }`;
        echo $status;
    }
?>