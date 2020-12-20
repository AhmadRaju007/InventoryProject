<?php
    session_start();
    include ('navigation.php');

    $m='';
    $conn=connect();

    $id= $_SESSION['userid'];
    $sq= "SELECT * FROM users_info WHERE id='$id'";
    $thisUser= mysqli_fetch_assoc($conn->query($sq));
    if($thisUser['is_admin']!=1){
        header("Location: dashboard.php");
    }


?>