<?php
require_once 'connection.php';

$id = $_GET['id'] ;
$sql = "DELETE FROM `tbl_form` WHERE `tbl_form`.`register_id` = $id";
$result = mysqli_query($con,$sql);

if($result == 1){
    header("location:viewdata.php");
}


