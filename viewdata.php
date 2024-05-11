<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abc crud</title>
</head>
<?php
require_once 'session.php';
require_once 'connection.php';
require_once 'index.php';   



?>

<body>
    <table border="1">
        <th>name</th>
        <th>photo</th>
        <th>email</th>
        <th>mobile</th>
        <th>ps</th>
        <th>city</th>
        <th>delete</th>
        <?php

        $dis = "SELECT * FROM `tbl_form`";
        $result2 = mysqli_query($con, $dis);
        if ($result2->num_rows == 0) {
            ?>
            <tr>
                <table border="1">
                    <td><?php echo 'no record available'; ?></td>
                    <table>
            </tr>
            <?php
        }
        while ($data = mysqli_fetch_object($result2)) {
            ?>
            <tr>

                <td><?php echo $data->name; ?></td>
                <td><img src="<?php echo $data->path; ?>" alt="no photo" width="100px" height="100px"></td>
                <td><?php echo $data->email; ?></td>
                <td><?php echo $data->mobileno; ?></td>
                <td><?php echo $data->password; ?></td>
                <td><?php echo $data->city; ?></td>
                <td><a href="delete.php?id=<?php echo $id = $data->register_id; ?>"
                        onclick="confirm('are you sure want to delete?')">delete</a></td>
            </tr>
            <?php

        }

        ?>

    </table>
</body>

</html>