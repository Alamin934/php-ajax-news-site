<?php
include "../config.php";
session_start();
if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}

$post_per_page = 5;
$page = "";
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];
}else{
    $page = 1;
}

$offset = ($page-1)*$post_per_page;

$post_sql = "SELECT post.post_id,post.title,post.post_date,category.category_name,user.username,user.role FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author=user.user_id ORDER BY post_id DESC LIMIT {$offset},{$post_per_page}";
$post_query = mysqli_query($conn, $post_sql) or die("Load Post Query Failed");

$output = "";

$sl_no = $offset +1;
if(mysqli_num_rows($post_query) > 0){
    $output.="<table class='content-table'>
                <thead>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>";
    while($post = mysqli_fetch_assoc($post_query)){
        if($post['role'] == 1){
            $user_role = "Admin";
        }else{
            $user_role = "User";
        }
        $output.= "<tr>
                    <td class='id'>{$sl_no}</td>
                    <td>{$post['title']}</td>
                    <td>{$post['category_name']}</td>
                    <td>{$post['post_date']}</td>
                    <td>{$post['username']} ({$user_role})</td>
                    <td class='edit' id='edit-post' data-ep_id='{$post['post_id']}'><a href=''><i class='fa fa-edit'></i></a></td>
                    <td class='delete' id='delete-post' data-dp_id='{$post['post_id']}'><a href=''><i class='fa fa-trash-o'></i></a></td>
                </tr>";
    $sl_no++;
    }
    $output.="  </tbody>
            </table>";
    
    $pagi_sql = "SELECT * FROM post";
    $pagi_query = mysqli_query($conn, $pagi_sql) or die("Post pagination Query Failed");

    $total_posts = mysqli_num_rows($pagi_query);
    $total_page = ceil($total_posts/$post_per_page);

    $output.="<ul class='pagination admin-pagination'>";
            for($p=1; $p <=$total_page; $p++){
                if($p == $page){
                    $active = 'active';
                }else{
                    $active='';
                }
                $output.="<li class='{$active}'><a href='' id='{$p}'>{$p}</a></li>";
            }
    $output.= "</ul>";
}else{
    $output.="<table class='content-table'>
                <thead>
                    <th>S.No.</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Author</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    <tr><td colspan='7'>
                        <h3>Post not found</h3>
                    </td></tr>
                </tbody>";
}
echo $output;

