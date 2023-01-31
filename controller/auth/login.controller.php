<?php

require "./views/layouts/app.layout.php";

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $select = mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'");
    $row = mysqli_fetch_array($select);

    if(is_array($row)) {
        $id = $row["id"];
        $name = $row["name"];
        $profile = $row["profile"];
        $sessionToken = uniqid();
        $sql = "INSERT INTO `sessions` (session_token, is_expired, user_id) VALUES ('$sessionToken', 0, '$id')";
        $result = $con->query($sql);
        $_SESSION["token"] = $sessionToken;
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $name;
        $_SESSION["profile"] = $profile;
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('invalid credentials')";
        echo " </script> ";
    }

    if(isset($_SESSION['token'])) {
        header("location:dashboard");
    } else {
        header("location:login");
    }
}

require "views/pages/auth/login.php";