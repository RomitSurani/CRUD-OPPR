<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>

<div>

    <?php
    require_once 'index.php';
    require_once 'connection.php';
    require_once 'session.php';
    if (isset($register_id)) {
        $sql = "SELECT * FROM `tbl_form` WHERE `register_id` = $register_id";
        $result = mysqli_query($con, $sql);
        while ($data = mysqli_fetch_object($result)) {
            ?>
            <div class="container">
                <div class="row justify-content-center">
                        <div class="card m-5">
                            <div class="card-header">
                                <h1><?php echo strtoupper($data->name); ?>'S PROFILE</h1>
                            </div>
                            <div class="card-body p-3">
                                <img src="<?php echo $data->path ?>" alt=""
                                    style="width: 100px; height : 100px; border: 1px solid yellow; border-radius:300px;">
                                </br>
                                </br>
                                <label for=""><b>Name : </b><?php echo $data->name; ?></label><br>
                                <label for=""><b>Email : </b><?php echo $data->email; ?></label><br>
                                <label for=""><b>Mobile : </b><?php echo $data->mobileno; ?></label><br>
                                <label for=""><b>City : </b><?php echo $data->city; ?></label><br><br>
                                <label for=""><a style = "text-decoration:none;" href="update.php?id=<?php echo $id = $data->register_id; ?>">update</a></label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
    </body>

</html>