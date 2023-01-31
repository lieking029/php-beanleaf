<?php
require "./views/layouts/app.layout.php";

if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "insert into `users` (name, email, password) values ('$name', '$email', '$password' ) ";
    $result = mysqli_query($con, $sql);
    if($name === "" || $email === "" || $password === "") {
        echo "<script type='text/javascript'> ";
        echo "alert('please fill all the fields')";
        echo "</script>";
    } else if ($result) {
        header("location:login");
    } else {
        die(mysqli_error($con));
    }
}

require 'views/pages/auth/register.php';
