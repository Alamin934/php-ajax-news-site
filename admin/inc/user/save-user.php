<?php 
include "../config.php";


    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    $update_sql = "UPDATE user SET first_name = '{$first_name}', last_name = '{$last_name}', username = '{$username}', role = {$role} WHERE user_id = {$user_id}";
    if(mysqli_query($conn, $update_sql)){
        echo 1;
    }else{
        echo 0;
    }
