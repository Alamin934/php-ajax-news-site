<?php
include "../config.php";

if(isset($_POST['id'])){
    $del_id = $_POST['id'];

    $del_sql = "DELETE FROM user WHERE user_id = {$del_id}";

    if(mysqli_query($conn, $del_sql)){
        echo 1;
    }else{
        echo 0;
    }


}