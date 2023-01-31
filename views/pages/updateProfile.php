<?php
require "./views/layouts/app.layout.php";

    if(!$_SESSION["token"]) {
        header("location:login");
    }

$id = $_SESSION["id"];
$select = "SELECT * FROM `users` WHERE id=$id ";
$sql = mysqli_query($con, $select);

$row = mysqli_fetch_assoc($sql);
$name = $row["name"];
$email = $row["email"];
$id = $row["id"];
$profile = $row["profile"];

    if(isset($_POST["submit"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];

        $filename = $_FILES["profile"]["name"];
        $tempname = $_FILES["profile"]["tmp_name"];
        $profile = "images/profile/" . $filename;
        move_uploaded_file($tempname, $profile);

        $select = "UPDATE `users` SET name='$name', email='$email', profile='$profile' WHERE id='$id'";
        $result = mysqli_query($con, $select);

    dd($result);

        if($result) {
            echo "success";
        } else {
            echo "failed";
        }

    }

?>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card p-3 col-lg-6">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label> Name </label>
                <input type="text" class="form-control" placeholder="Name" name="name" value='<?php echo $name ?>' />
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                <input type="text" class="form-control"  placeholder="Email" name="email" value='<?php echo $email ?>' />
                </div>
                <div class="form-group">
                    <label>Profile Picture</label>
                    <input type="file" class="form-control"  name="profile" />
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary" name="submit" >Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>