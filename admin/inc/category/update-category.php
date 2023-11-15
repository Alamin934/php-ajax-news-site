<?php 
include "../config.php";
session_start();
if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}

$cat_id = $_POST['c_id'];
$cat_name = $_POST['c_name'];

$cat_sql = "UPDATE category SET category_name = '{$cat_name}' WHERE category_id = {$cat_id}";
if(mysqli_query($conn, $cat_sql)){
    echo 1;
}else{
    echo 0;
}

