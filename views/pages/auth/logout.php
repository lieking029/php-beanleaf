<?php

require './functions.php';
include './environment.php';

    session_start();
    $select = "SELECT * FROM `sessions`";
    $sql = mysqli_query($con, $select);
    $row = mysqli_fetch_array($sql);
    $sessionToken = $_SESSION["token"];
    $result = "UPDATE `sessions` SET is_expired = 1 WHERE session_token = '$sessionToken' ";
    
    if($con->query($result) === TRUE) {
        session_destroy();
        header('location:login');
    } else {
        return;
    }

$con->close();

    
    // dd($result)


?>