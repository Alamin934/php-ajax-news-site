<?php
include "../config.php";
session_start();
if(isset($_SESSION['user_name'])){
    $del_id = $_POST['id'];
    $post_sql = "SELECT * FROM post WHERE post_id = {$del_id}";
    $post_query = mysqli_query($conn, $post_sql) or die("Load Single Post Query Failed");

    $post= mysqli_fetch_assoc($post_query);

    if(is_file("../../upload/".$post['post_img'])){
        unlink("../../upload/".$post['post_img']);
        $del_sql = "DELETE FROM post WHERE post_id ={$del_id};";
        $del_sql.="UPDATE category SET post = post-1 WHERE category_id = {$post['category']}";
    
        if(mysqli_multi_query($conn, $del_sql)){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        $del_sql = "DELETE FROM post WHERE post_id ={$del_id};";
        $del_sql.="UPDATE category SET post = post-1 WHERE category_id = {$post['category']}";
    
        if(mysqli_multi_query($conn, $del_sql)){
            echo 1;
        }else{
            echo 0;
        }
    }


}else{
    header("Location: {$hosturl}/admin");
}

