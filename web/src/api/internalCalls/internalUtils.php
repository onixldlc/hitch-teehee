<?php
    function checkInternal(){
        require(__DIR__."/../controller/config.php");
        if($REQ_DOMAIN_NAME !== "php"){
            echo "this page is reserve for internal call only !!!";
            die;
        }
    }
?>