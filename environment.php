<?php 
    $con = new mysqli('localhost', 'root', '', 'crud');
    session_start();
   if(!$con) {
       die(mysqli_error($con));
}
?>