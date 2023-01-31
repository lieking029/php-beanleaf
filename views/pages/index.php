<?php
require "./views/layouts/app.layout.php";

    if(!$_SESSION["token"]) {
        header("location:login");
    }

    
?>



    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-3">
            <div>
                <?php
                    $id = $_SESSION["id"];
                    $select = "SELECT * FROM `users` WHERE id=$id ";
                    $sql = mysqli_query($con, $select);

                    $row = mysqli_fetch_assoc($sql);
                    $profile = $row["profile"];
                    $name = $row["name"];

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
                        <img src="https://scontent.fmnl13-2.fna.fbcdn.net/v/t39.30808-6/316541946_876752107083217_5841789909563890176_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeHp6OL09d2UfnUuFcRlp8baIdqJpC8rMSgh2omkLysxKCdoRpbmZRyInp5_zCnXNT8QmYMTBdoAECcciFLtEg89&_nc_ohc=43_j5xmtnF4AX8pkb_w&_nc_ht=scontent.fmnl13-2.fna&oh=00_AfAeCFT1YaxW2oJRP2qyxDlcjwK81unTk6024MXZEsPV8A&oe=63D2885B" class="rounded-circle img-fluid" height="35" width="35" />
                        <a href="create-post" class="form-control text-center mx-2" style="text-decoration: none;" >
                            What's on your mind, John Michael ?
                        </a>
                        </div>
                </div>

                <?php
                    $select = "SELECT * FROM `post`";
                    $sql = mysqli_query($con, $select);

                    if($sql) {
                        while($row = mysqli_fetch_assoc($sql)) {
                        $id = $row["id"];
                        $image = $row["image"];
                        $caption = $row["caption"];
                        $name = $row["poser_name"];
                        $date = $row["date"];
                        $tempname = $row["tmp_name"];

                        if($tempname === "") {
                            echo '
                            <div class="card">
                            <div class="card-header">
                                <img src="https://scontent.fmnl13-2.fna.fbcdn.net/v/t39.30808-6/316541946_876752107083217_5841789909563890176_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeHp6OL09d2UfnUuFcRlp8baIdqJpC8rMSgh2omkLysxKCdoRpbmZRyInp5_zCnXNT8QmYMTBdoAECcciFLtEg89&_nc_ohc=43_j5xmtnF4AX8pkb_w&_nc_ht=scontent.fmnl13-2.fna&oh=00_AfAeCFT1YaxW2oJRP2qyxDlcjwK81unTk6024MXZEsPV8A&oe=63D2885B" class="rounded-circle img-fluid" height="35" width="35" />
                                <label style="font-size: 15px; margin-top: 20px;" class="mx-2" ><strong>'.$name.'</strong>
                                <span style="font-size: 12px;">'.$date.'</span>
                            </label> 
                                <p>'.$caption.'</p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col border border-grey">
                                        <i class="fas fa-thumbs-up"></i>
                                        <span>Like</span>
                                    </div>
                                    <div class="col border border-grey">
                                        <i class="fas fa-share"></i>
                                        <span>Share</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                        } else {
                        echo '
                        <div class="card">
                        <div class="card-header">
                            <img src="https://scontent.fmnl13-2.fna.fbcdn.net/v/t39.30808-6/316541946_876752107083217_5841789909563890176_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeHp6OL09d2UfnUuFcRlp8baIdqJpC8rMSgh2omkLysxKCdoRpbmZRyInp5_zCnXNT8QmYMTBdoAECcciFLtEg89&_nc_ohc=43_j5xmtnF4AX8pkb_w&_nc_ht=scontent.fmnl13-2.fna&oh=00_AfAeCFT1YaxW2oJRP2qyxDlcjwK81unTk6024MXZEsPV8A&oe=63D2885B" class="rounded-circle img-fluid" height="35" width="35" />
                            <label style="font-size: 15px; margin-top: 20px;" class="mx-2" ><strong>'.$name.'</strong>
                            <span style="font-size: 12px;">'.$date.'</span>
                         </label> 
                            <p>'.$caption.'</p>
                        </div>
                        <div class="text-center">
                            <img src='.$image.' class="img-fluid" style="width: 100%;" />;
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col border border-grey">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>Like</span>
                                </div>
                                <div class="col border border-grey">
                                    <i class="fas fa-share"></i>
                                    <span>Share</span>
                                </div>
                            </div>
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
                <div class="container-fluid">
                    <div class="d-flex">
                    <img src="https://scontent.fmnl13-2.fna.fbcdn.net/v/t39.30808-6/321397147_702623158174024_2597572170439471206_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=09cbfe&_nc_eui2=AeEkQd1nzazxB_COr8iowKpYpt6HklvYnqqm3oeSW9ieqhU2NXGdC8FnsRIRt-u91w4PhnJ-WvV7q1ENibqYArHL&_nc_ohc=SbTt2lsOaIsAX85TPI9&_nc_ht=scontent.fmnl13-2.fna&oh=00_AfDYCzga6FZUJhS_IgdcYFI1StbQiwZ1cyHGWEo4N7o4DA&oe=63D289AC" alt="" class="rounded-circle image-fluid" height="55" width="55" >
                    <p class="mx-2" > <strong>John Doe asdsad  sadsadsa  sadsa </strong> liked to your post  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>