<?php
include "../config.php";
session_start();
if(!isset($_SESSION['user_name']) ){
    header("Location: {$hosturl}/admin");
}
$old_cat_id = $_GET['old_cat'];
$post_id = $_POST['post_id'];
$post_title = $_POST['post_title'];
$post_desc = $_POST['postdesc'];
$post_cat = $_POST['category'];
$old_img = $_POST['old-image'];
$post_date = date('d M, Y');
$post_author = $_SESSION['user_id'];

if(isset($_FILES['new-image'])){
    $img_name = $_FILES['new-image']['name'];
    $img_tmp_name = $_FILES['new-image']['tmp_name'];
    $img_size = $_FILES['new-image']['size'];

    $error = [];

    $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $valid_ext = ["jpg", "jpeg", "png"];

    if(in_array($ext, $valid_ext) === false){
        $error[] = "This extension file is not allowed, Please a JPG or PNG file";
    }
    if($img_size > 2097152){
        $error[] = "File size must be in 2mb or lower";
    }

    $new_name = basename($img_name, ".".$ext)."-".date('Y-m-d-His').".".$ext;
    $path = "../../upload/".$new_name;

    if(empty($error)){
        move_uploaded_file($img_tmp_name, $path);
        unlink("../../upload/".$old_img);
    }else{
        print_r($error);
        die();
    }
    
    $post_sql= "UPDATE post SET title = '{$post_title}', description = '{$post_desc}', category = {$post_cat}, post_date = '{$post_date}', author = {$post_author}, post_img = '{$new_name}' WHERE post_id = {$post_id};";
    
    $post_sql.= "UPDATE category SET post = post + 1 WHERE category_id = {$post_cat};";
    
    $post_sql.= "UPDATE category SET post = post - 1 WHERE category_id = {$old_cat_id}";
    
    if(mysqli_multi_query($conn, $post_sql)){
        echo 1;
    }else{
        echo 0;
    }
}