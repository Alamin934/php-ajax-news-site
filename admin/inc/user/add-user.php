<?php 
include "../config.php";

if($_POST['fname'] != '' || $_POST['lname'] != '' || $_POST['user'] != '' || $_POST['password'] != '' || $_POST['role'] != ''){

    $first_name = mysqli_real_escape_string($conn, $_POST['fname']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lname']);
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = md5($_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $update_sql = "INSERT INTO user(first_name,last_name,username,password,role) VALUES('{$first_name}','{$last_name}','{$username}','{$password}',{$role})";

    if(mysqli_query($conn, $update_sql)){
        echo 1;
    }else{
        echo 0;
    }
}else{
    echo "All Fields must be required";
}



