<?php 
include "../config.php";
session_start();
if(!isset($_SESSION['user_name']) && $_SESSION['user_role'] != 1){
    header("Location: {$hosturl}/admin");
}

if(isset($_POST['cat_name'])){

    $cat_name = mysqli_real_escape_string($conn, $_POST['cat_name']);

    $insert_sql = "INSERT INTO category(category_name) VALUES('{$cat_name}')";

    if(mysqli_query($conn, $insert_sql)){
        echo 1;
    }else{
        echo 0;
    }
}else{
    echo "All Fields must be required";
}



