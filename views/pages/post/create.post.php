<?php
require "./views/layouts/app.layout.php";

    if(!$_SESSION["token"]) {
        header("location:login");
    }

    

    if(isset($_POST['submit'])){

        $id = $_SESSION["id"];
        $poserName = $_SESSION["name"];

        $caption = $_POST["caption"];

        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "images/" . $filename;
        move_uploaded_file($tempname, $folder);

        $sql = " INSERT INTO `post` ( caption , image, user_id, poser_name, date, tmp_name ) VALUES ('$caption', '$folder', '$id', '$poserName', NOW(), '$tempname') ";
        $data = mysqli_query($con, $sql);

        if($data) {
            header('location:dashboard');
        } else {
            echo "failed";
        }

    }
?>

<div class="col-lg-6">
<form action="" method="POST" enctype="multipart/form-data" >
            <div class="modal-body">
             <input type="text" name="caption" class="form-control " placeholder="What's on your mind, John Michael ?">
            <input type="file" name="image" class="form-control my-2">
         </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="submit" >Save changes</button>
    </div>
</form>
</div>