<?php
    class customSessionHandler{
        public mysqli $connection;

        public function __construct(mysqli $conn) {
            $this->connection = $conn;
        }
        
        public function checkSession(string $userID, string $sessionID){
            $result = $this->connection->query("SELECT `sessionID`, `userID` FROM `session` WHERE userID = '{$userID}' OR sessionID = '{$sessionID}'");
            return $result->fetch_array();
        }
        
        public function addSessionToDB($sessionID, $userID){
            $this->connection->query("INSERT INTO `session`(`sessionID`, `userID`) VALUES ('{$sessionID}','{$userID}')");
        }
        
        public function deauthAllSession($sessionID, $userID){
            $this->connection->query("DELETE FROM `session` WHERE sessionID = '{$sessionID}' OR userID = '{$userID}'");
        }

        public function deauthThisSession($sessionID, $userID){
            $this->connection->query("DELETE FROM `session` WHERE sessionID = '{$sessionID}'");
        }
    }

    class authHandler extends customSessionHandler{
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