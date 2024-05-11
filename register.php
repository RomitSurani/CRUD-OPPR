<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abc crud</title>
</head>
<?php
require_once 'connection.php';
require_once 'index.php';
?>

<body>
    <?php
    if (isset($_POST['submit'])) {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // echo $ext;  
        // die();
//                            -------- validations of cotrols --------
        $ptr = "/^[a-zA-Z ]+$/";

        if ($_POST['name'] == "") {
            $name_err = "Please Enter the name!";
        } else
            if (!preg_match($ptr, $_POST['name'])) {
                $name_err = 'Please Enter Valid Name!';
            }
        if ($_POST['email'] == "") {
            $email_err = "Please Enter the email!";
        } else
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email_err = 'Please Enter Valid Email!';
            }
        if ($_POST['mobile'] == "") {
            $mobile_err = "Please Enter the mobile!";
        }
        if ($_POST['ps'] == "") {
            $ps_err = "Please Enter the password!";
        } else
            if (strlen($_POST['ps']) < 8 || strlen($_POST['ps']) > 16) {
                $ps_err = 'Enter Valid Password';
            }
        if ($_POST['cps'] == "") {
            $cps_err = "Please Enter the confirm password!";
        } else
            if ($_POST['cps'] !== $_POST['ps']) {
                $cps_err = "password and confirm password does not matching";
            }
        if ($_POST['city'] == "") {
            $city_err = "Please Selete City!";
        }
    

        //                                       ---- uniqe email validate---
        $dis = "SELECT * FROM `tbl_form`";
        $result2 = mysqli_query($con, $dis);
        while ($data = mysqli_fetch_object($result2)) {
            if ($data->email == $_POST["email"]) {
                $email_err = "Entered email is alreay exist";
            }
        }
        //                                       ---- click even of insert ----
    
        if (!isset($name_err) && !isset($email_err) && !isset($mobile_err) && !isset($ps_err) && !isset($cps_err) && !isset($city_err)) {
            // echo "hiii";
            // die();
            //                                            ==== image uplaoding ====
            $ext = ".".substr($_FILES['photo']['type'], 6);
            
            if ($_FILES['photo']['name'] == "") {
                $err = "please select image";
            }
            if (!isset($err)) {

                $file_name = $_FILES['photo']['name'];
                $file_size = $_FILES['photo']['size'];
                $file_tmp = $_FILES['photo']['tmp_name'];
                $file_type = $_FILES['photo']['type'];
                $show = "SELECT * FROM `tbl_img`";
                $res2 = mysqli_query($con, $show);
                $folder = "../img/" . $file_name;
                if ($_FILES['photo']['error'] == 0 && strlen($_FILES['photo']['name']) > 0) {
                    // print_r($data);
                    // die();
                    move_uploaded_file($file_tmp, $folder);
                   
                } else {
                    $err = "SOME tHING WENT WRONG";
                }
            }

            //                                      =========insert==========

            $sql = "INSERT INTO `tbl_form`(`register_id`, `name`, `email`, `mobileno`, `password`, `city` , `path`) VALUES (0,'" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['mobile'] . "','" . $_POST['ps'] . "','" . $_POST['city'] . "' , '$folder')";
            $result = mysqli_query($con, $sql);


            if (($result) == 1) {
                $success = "Registered Successfully <b>✓</b>";
            }
        }
    }
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8-md">
                <div class="card m-5">
                    <div class="card-header">
                        <h1>Register</h1>
                    </div>
                    <div class="card-body p-5">
                        <form class="" action="" method="post" enctype="multipart/form-data">

                            <label>name :
                                <input type="text" name="name" placeholder="enter the name" value="<?php
                                if (isset($_POST['name'])) {
                                    echo $_POST['name'];
                                }
                                ?>">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($name_err)) {
                                    echo $name_err;
                                }
                                ?>
                            </span></br></br>



                            <label>email :
                                <input type="text" name="email" placeholder="enter the email" value="<?php
                                if (isset($_POST['email'])) {
                                    echo $_POST['email'];
                                }
                                ?>">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($email_err)) {
                                    echo $email_err;
                                }
                                ?>
                            </span></br></br>


                            <label>mobile :
                                <input type="text" name="mobile" placeholder="enter the mobile number" value="<?php
                                if (isset($_POST['mobile'])) {
                                    echo $_POST['mobile'];
                                }
                                ?>">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($mobile_err)) {
                                    echo $mobile_err;
                                }
                                ?>
                            </span></br></br>


                            <label>password :
                                <input type="password" name="ps" placeholder="enter the password" value="<?php
                                if (isset($_POST['ps'])) {
                                    echo $_POST['ps'];
                                }
                                ?>">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($ps_err)) {
                                    echo $ps_err;
                                }
                                ?>
                            </span></br></br>


                            <label>comfirm password :
                                <input type="password" name="cps" placeholder="enter the comfirm password">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($cps_err)) {
                                    echo $cps_err;
                                }
                                ?>
                            </span></br></br>


                            <label>city :
                                <select name=" city">

                                    <option value="">choose -- city</option>
                                    <option value="ahemdabad" <?php if (isset($_POST['city']) && ($_POST['city']) == "ahemdabad") {
                                        echo 'selected';
                                    } ?>>ahemdabad</option>
                                    <option value="surat" <?php if (isset($_POST['city']) && ($_POST['city']) == "surat") {
                                        echo 'selected';
                                    } ?>>surat</option>
                                    <option value="vapi" <?php if (isset($_POST['city']) && ($_POST['city']) == "vapi") {
                                        echo 'selected';
                                    } ?>>vapi</option>
                                    <option value="bhavnagar" <?php if (isset($_POST['city']) && ($_POST['city']) == "bhavnagar") {
                                        echo 'selected';
                                    } ?>>bhavnagar</option>
                                </select>

                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($city_err)) {
                                    echo $city_err;
                                }
                                ?>
                            </span></br></br>

                            <label>Add image :
                                <input type="file" name="photo" placeholder="enter the image">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($img_err)) {
                                    echo $img_err;
                                }
                                ?>
                            </span></br></br>

                            <button class="btn btn-warning" type="submit" name="submit" value="yes">s u b m i t</button>
                            <span style="color : green" ;>
                                <?php
                                if (isset($success)) {
                                    echo $success;
                                }
                                ?>
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>

</html>