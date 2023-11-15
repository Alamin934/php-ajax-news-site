<?php
include "../config.php";
session_start();
if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}
// Load Category for insert post
if($_SERVER["REQUEST_METHOD"]=="POST" && $_GET['action']=='cat'){
    $cat_sql = "SELECT * FROM category";
    $cat_query = mysqli_query($conn, $cat_sql) or die("User Query Failed");
    
    if(mysqli_num_rows($cat_query)>0){
        echo '<option value="" selected disabled> Select Category</option>';
        while($cat = mysqli_fetch_assoc($cat_query)){
            echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
        }
    }
}



if($_SERVER["REQUEST_METHOD"]=="POST" && $_GET['action']=='post'){
    $post_title = $_POST['post_title'];
    $post_desc = $_POST['postdesc'];
    $post_cat = $_POST['category'];
    $post_date = date('d M, Y');
    $post_author = $_SESSION['user_id'];

    if(isset($_FILES['fileToUpload'])){
        $img_name = $_FILES['fileToUpload']['name'];
        $img_tmp_name = $_FILES['fileToUpload']['tmp_name'];
        $img_size = $_FILES['fileToUpload']['size'];

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
        }else{
            print_r($error);
            die();
        }

        $post_sql= "INSERT INTO post(title, description, category, post_date, author, post_img) VALUES('{$post_title}', '{$post_desc}', {$post_cat}, '{$post_date}', {$post_author}, '{$new_name}');";

        $post_sql.= "UPDATE category SET post = post + 1 WHERE category_id = {$post_cat}";

        if(mysqli_multi_query($conn, $post_sql)){
            echo 1;
        }else{
            echo 0;
        }
    }


}