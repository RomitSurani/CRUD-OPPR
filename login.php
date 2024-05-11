
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
    session_start();
    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = $_POST['ps'];

        if (isset($_POST['remember']) && $_POST['remember'] == "on") {
            setcookie("remember_email", "$email", time() + (30 * 24 * 60 * 60), "/");
        } else {
            setcookie("remember_email", "$email", time() - 3600, "/");
        }

        $sql = "SELECT * FROM `tbl_form`";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_object($result)) {
            if ($row->email == $_POST["email"] && $row->password == $_POST['ps']) {
                $_SESSION['login'] = $_POST['email'];
                $_SESSION['login'] = $row->register_id;
                header("location:profile.php");
            } else {
                $error = "email or password is wrong";
            }

        }
        // $_POST['email'] = $email;
    
        // -----------------------session-----------------------
    
    }
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8-md">
                <div class="card m-5">
                    <div class="card-header">
                        <h1>Login</h1>
                    </div>
                    <div class="card-body p-5">
                        <form class="" action="" method="post">


                            <label>email :
                                <input type="text" name="email" placeholder="enter the email"
                                    value="<?php if (isset($_COOKIE['remember_email'])) {
                                        echo $_COOKIE['remember_email'];
                                    } ?>">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($email_err)) {
                                    echo $email_err;
                                }
                                ?>
                            </span></br>


                            <label>password :
                                <input type="password" name="ps" placeholder="enter the password">
                            </label><span style="color : red" ;></br>
                                <?php
                                if (isset($ps_err)) {
                                    echo $ps_err;
                                }
                                ?>
                            </span></br>
                            <label><input type="checkbox" style="cursor:ponter;" name="remember"> Remember
                                Me</label></br>

                            <button class="btn btn-warning" type="submit" name="submit" value="yes">L o g i n</button>
                            </br>
                            <span style="color:red">
                                <?php if (isset($error)) {
                                    echo $error;
                                } ?>
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>

</html>