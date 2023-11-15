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
        while($cat = mysqli_fetch_assoc($cat_query)){
            echo "<option value='{$cat['category_id']}'>{$cat['category_name']}</option>";
        }
    }
}



if($_SERVER["REQUEST_METHOD"]=="POST" && $_GET['action']=='post'){
    $post_title = $_POST['post_title'];
    $post_desc = $_POST['postdesc'];
    $post_cat = $_POST['category'];
    $post_date = date('d M,Y');
    $post_author = $_SESSION['user_id'];

    if(isset($_FILES['fileToUpload'])){
        $img_name = $_FILES['fileToUpload']['name'];
        $img_tmp_name = $_FILES['fileToUpload']['tmp_name'];

        $error = [];

        $ext = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $valid_ext = ["jpg, jpeg, png"];

        if(in_array($ext, $valid_ext)){

        }

    }

}