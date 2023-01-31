<?php

function dd($value){
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}


function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}


function isExpired() {
    require './environment.php';
    $sessionToken = $_SESSION["token"];
    $select = "SELECT * FROM `sessions` WHERE session_token = '$sessionToken' LIMIT 1";
    $sql = mysqli_query($con, $select);
    $row = mysqli_fetch_array($sql);
    if($row["is_expired"] === 1) {
        header("location:login");
    }
}

?>