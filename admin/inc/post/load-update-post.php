<?php
include "../config.php";
session_start();
if(!isset($_SESSION['user_name']) ){
    header("Location: {$hosturl}/admin");
}
$edit_id = $_POST['id'];
$load_sql = "SELECT * FROM post WHERE post_id = {$edit_id}";
$load_query = mysqli_query($conn, $load_sql) or die("Load Post Query Failed");

$output = "";
if(mysqli_num_rows($load_query)>0){
    while($single_post = mysqli_fetch_assoc($load_query)){
        $output.="<div class='form-group'>
                    <input type='hidden' name='post_id'  class='form-control' value='{$single_post['post_id']}'>
                </div>
                <div class='form-group'>
                    <label for='exampleInputTile'>Title</label>
                    <input type='text' name='post_title'  class='form-control' id='exampleInputUsername' value='{$single_post['title']}'>
                </div>
                <div class='form-group'>
                    <label for='exampleInputPassword1'> Description</label>
                    <textarea name='postdesc' class='form-control'  required rows='5'>{$single_post['description']}</textarea>
                </div>
                <div class='form-group'>
                    <label for='exampleInputCategory'>Category</label>
                    <select class='form-control' name='category'>
                        <option hidden id='old_post_cat' value='{$single_post['category']}'></option>";
                    $cat_sql = "SELECT * FROM category";
                    $cat_query = mysqli_query($conn, $cat_sql) or die("User Query Failed");
                    if(mysqli_num_rows($cat_query)>0){
                        while($cat = mysqli_fetch_assoc($cat_query)){
                            if($cat['category_id'] == $single_post['category']){
                                $selected = 'selected';
                            }else{$selected='';}

                        $output.= "<option {$selected} value='{$cat['category_id']}'>{$cat['category_name']}</option>";
                        }
                    }
            $output.="</select>
                </div>
                <div class='form-group'>
                    <label for=''>Post image</label>
                    <input type='file' name='new-image'>
                    <img  src='upload/{$single_post['post_img']}' height='150px'>
                    <input type='hidden' name='old-image' value='{$single_post['post_img']}'>
                </div>
                <input type='submit' class='btn btn-primary' value='Update' />";
    }
}

echo $output;
