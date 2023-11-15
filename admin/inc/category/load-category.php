<?php
include "../config.php";
session_start();
if(!isset($_SESSION['user_name']) && $_SESSION['user_role'] != 1){
    header("Location: {$hosturl}/admin");
}
$limit = 5;
$page= "";
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];
}else{
    $page = 1;
}
$offset = ($page-1) * $limit;

$category_sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset},{$limit}";
$category_query = mysqli_query($conn, $category_sql) or die("User Query Failed");

$output = "";
if(mysqli_num_rows($category_query) > 0){
    $output.= " <table class='content-table' >
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>";
    while($category = mysqli_fetch_assoc($category_query)){
        $output.="<tr>
                    <td class='id'>{$category['category_id']}</td>
                    <td>{$category['category_name']}</td>
                    <td>{$category['post']}</td>
                    <td class='edit_cat' data-ec_id='{$category['category_id']}'><a href=''><i class='fa fa-edit'></i></a></td>
                    <td class='delete_cat' data-dc_id='{$category['category_id']}'><a href=''><i class='fa fa-trash-o'></i></a></td>
                </tr>";                   
    }
    $output.= "</tbody></table>";

    $pagi_sql = "SELECT * FROM category";
    $pagi_query = mysqli_query($conn, $pagi_sql) or die("User Query Failed");
    $total_cat = mysqli_num_rows($pagi_query);
    $total_page = ceil($total_cat/$limit);

    $output.="<ul class='pagination admin-pagination'>";
                for($p=1; $p<=$total_page; $p++){
                    if($p == $page){
                        $active = 'active';
                    }else{$active='';}
                    $output.= "<li class='{$active}'><a href='' id='{$p}'>{$p}</a></li>";
                }
    $output.="</ul>";
}else{
    $output.= "<h2 style='text-align:center;'>Category Not Found</h2>";
}

echo $output;