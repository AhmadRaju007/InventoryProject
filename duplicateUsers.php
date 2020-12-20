<?php
    include('auth/connection.php');
    $conn= connect();

    $user= $_POST['username'];

    $sql= "SELECT * FROM users_info WHERE u_name='$user'";
    $flag= $conn->query($sql);

    $retData['success']= false;
    if(mysqli_num_rows($flag)>0){
        $retData['success']= true;
    }
    echo json_encode($retData);
?>