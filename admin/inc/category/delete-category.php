<?php
include "../config.php";
session_start();
if(!isset($_SESSION['user_name']) && $_SESSION['user_role'] != 1){
    header("Location: {$hosturl}/admin");
}

if(isset($_POST['id'])){
    $del_id = $_POST['id'];

    $del_sql = "DELETE FROM category WHERE category_id = {$del_id}";

    if(mysqli_query($conn, $del_sql)){
        echo 1;
    }else{
        echo 0;
    }
}