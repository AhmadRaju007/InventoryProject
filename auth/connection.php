<?php
    function connect(){
        $dbHost= "localhost";
        $user= "root";
        $pass= "";
        $dbname="inventory_project";

        $conn= new mysqli($dbHost, $user, $pass, $dbname);
        //echo "connected";
        return $conn;
    }

    function closeConnect($cn){
        $cn->close();
    }
?>