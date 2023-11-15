<?php 
include "../config.php";
session_start();
if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}
$edit_id = $_POST['id'];

$cat_sql = "SELECT * FROM category WHERE category_id = {$edit_id}";
$cat_query = mysqli_query($conn, $cat_sql) or die("Load Update Category From query failed");

if(mysqli_num_rows($cat_query)>0){
    while($cat = mysqli_fetch_assoc($cat_query)){
        echo '<div class="form-group">
                <input type="hidden" id="cat_id"  class="form-control" value="'.$cat["category_id"].'" placeholder="">
            </div>
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" id="cat_name" class="form-control" value="'.$cat["category_name"].'"  placeholder="" required>
            </div>
            <input type="submit" id="update_cat" class="btn btn-primary" value="Update" required />';
    }
}



