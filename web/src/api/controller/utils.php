<?php
    function check($subdom){
        require("config.php");
        if($REQ_DOMAIN_NAME !== "$subdom".$SRV_DOMAIN_NAME){
            echo "you can only access this page from: <b>$subdom$SRV_DOMAIN_NAME</b>";
            die;
        }
    }
?>