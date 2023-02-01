<?php
require "./views/layouts/app.layout.php";

    if(!$_SESSION["token"]) {
        header("location:login");
    }

    $id = $_SESSION["id"];
    $select = "SELECT * FROM `users` WHERE id=$id ";
    $sql = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($sql);
    $profile = $row["profile"];
    $name = $row["name"];

    
?>



    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-3">
            <div>
                <?php
                    echo '
                    <img src='.$profile.' class="rounded-circle img-fluid" height="50" width="50" />
                    <label style="font-size: 20px; margin-top: 20px;" class="mx-2" ><strong> '.$name.' </strong></label>
                '
                ?>
                </div>
                <div>
                    <label style="margin-top: 20px;">
                    <i class="fas fa-clock" style="font-size: 40px; " ></i>
                    </label>
                    <label style="font-size: 18px;" class="mx-2" ><strong>My Recent Posts</strong></label>
                </div>
            </div>

            <div class="col-lg-6">

                <div class="card my-3">
                 <div class="d-flex p-3 ">
                    <?php
                        echo '
                        <img src='.$profile.' class="rounded-circle img-fluid" height="35" width="35" />
                        '
                        ?>
                        <a href="create-post" class="form-control text-center mx-2" style="text-decoration: none;" >
                            What's on your mind, John Michael ?
                        </a>
                        </div>
                </div>

                <?php

                    if(isset($_POST["submit"])) {
                        $id = $_SESSION["id"];
                        $react = $_POST["react"];

                    // dd($react);
                        $sql = "INSERT INTO `notifications` (user_id, likes) VALUES ('$id', '$react') ";
                        $data = mysqli_query($con, $sql);

                        if($data) {
                            header("location:dashboard");
                        } else {
                            echo "failed";
                        }
                    }                    

                    $select = "SELECT * FROM `post` LEFT JOIN `users` ON `users`.id = `post`.user_id ";
                    $sql = mysqli_query($con, $select);


                    if($sql) {
                        while($row = mysqli_fetch_assoc($sql)) {
                        $id = $row["id"];
                        $name = $row["name"];
                        $image = $row["image"];
                        $caption = $row["caption"];
                        $name = $row["name"];
                        $date = $row["date"];
                        $tempname = $row["tmp_name"];
                        $profile = $row["profile"];


                        if($tempname === "") {
                            echo '
                            <div class="card">
                            <div class="card-header">
                                <img src='.$profile.' class="rounded-circle img-fluid" height="35" width="35" />
                                <label style="font-size: 15px; margin-top: 20px;" class="mx-2" ><strong>'.$name.'</strong>
                                <span style="font-size: 12px;">'.$date.'</span>
                            </label> 
                                <p>'.$caption.'</p>
                            </div>
                            <div class="card-footer">
                                <form method="POST">
                                <div class="row">
                                <button class="col border border-grey" name="submit" >
                                    <i class="fas fa-thumbs-up"></i>
                                    <input value="like" name="react" style="border: none; cursor: pointer; background: transparent;"  />
                                </button>

                                <div class="col border border-grey">
                                    <i class="fas fa-share"></i>
                                    <span>Share</span>
                                </div>
                            </div>
                                </form>
                            </div>
                        </div>
                        ';
                        } else {
                        echo '
                        <div class="card">
                        <div class="card-header">
                            <img src='.$profile.' class="rounded-circle img-fluid" height="35" width="35" />
                            <label style="font-size: 15px; margin-top: 20px;" class="mx-2" ><strong>'.$name.'</strong>
                            <span style="font-size: 12px;">'.$date.'</span>
                         </label>
                            <p>'.$caption.'</p>
                        </div>
                        <div class="text-center">
                            <img src='.$image.' class="img-fluid" style="width: 100%;" />;
                        </div>
                        <div class="card-footer">
                        <form method="POST">
                        <div class="row">
                        <button class="col border border-grey" name="submit" >
                            <i class="fas fa-thumbs-up"></i>
                            <input value="like" name="react" style="border: none; cursor: pointer; background: transparent;"  />
                        </button>
                        <div class="col border border-grey">
                            <i class="fas fa-share"></i>
                            <span>Share</span>
                        </div>
                    </div>
                        </form>
                        </div>
                    </div>
                        ';
                    }
                        }
                    }
                ?>

                
                
            </div>


            <div class="col-lg-3"> 
                    <h3 class="p-2">Notifications</h3>

                    <?php

                    $id = $_SESSION["id"];
                    $select = "SELECT * FROM `notifications` LEFT JOIN `users` ON `users`.id = `notifications`.user_id AND `notifications`.user_id = $id WHERE  `notifications`.user_id = $id ";
                    $sql = mysqli_query($con, $select);
                    

                    if($sql) {
                        while($row = mysqli_fetch_assoc($sql)) {

                             $name = $row["name"];
                            $profile = $row["profile"];

                                echo '
                            <div class="container-fluid">
                            <div class="d-flex">
                            <img src='.$profile.' alt="" class="rounded-circle image-fluid" height="55" width="55" >
                            <p class="mx-2" > <strong> '.$name.' </strong> liked to your post  </p>
                            </div>
                        </div>
                            ';

                        }
                    }

                    ?>
                
            </div>
        </div>
    </div>