<?php
include "config.php";

if($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['action'] == 'login'){
    if(empty($_POST['username']) && empty($_POST['password'])){
        echo 0;
        die();  
    }else{
        $user_name = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql = "SELECT user_id, username, role FROM user WHERE username = '{$user_name}' AND password = '{$password}'";
        $query = mysqli_query($conn, $sql) or die("Login Query Failed");

        if(mysqli_num_rows($query) > 0){
            while($user = mysqli_fetch_assoc($query)){
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['username'];
                $_SESSION['user_role'] = $user['role'];
                echo 1;
            }
        }else{
            echo 2;
        }
    }
}else{
    echo 3; 
}