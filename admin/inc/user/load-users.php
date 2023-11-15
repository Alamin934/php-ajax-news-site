<?php
include "../config.php";

$item_per_page = 3;

if(isset( $_POST['pageNo'])){
    $page =  $_POST['pageNo'];
}else{
    $page = 1;
}
$offset = ($page-1)*$item_per_page;

$user_sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset}, {$item_per_page}";
$user_query = mysqli_query($conn, $user_sql) or die("User Query Failed");

$output = "";
if(mysqli_num_rows($user_query) > 0){
    $output.="<thead>
                <th>S.No.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>";
    $output.="<tbody>";
    while($user=mysqli_fetch_assoc($user_query)){
        if($user['role'] == 1){
            $user_role = "Admin";
        }else{
            $user_role = "User";
        }
        $output.="<tr>
                    <td class='id'>{$user['user_id']}</td>
                    <td>{$user['first_name']} {$user['last_name']}</td>
                    <td>{$user['username']}</td>
                    <td>{$user_role}</td>
                    <td class='edit_user' data-eu_id='{$user['user_id']}'><a href=''><i class='fa fa-edit'></i></a></td>
                    <td class='delete_user' data-du_id='{$user['user_id']}'><a href=''><i class='fa fa-trash-o'></i></a></td>
                </tr>";
    }
    $output.="</tbody>";
    // Pagination
    // 
    $pagi_sql = "SELECT * FROM user";
    $pagi_query = mysqli_query($conn, $pagi_sql) or die("User Query Failed");

    $total_users = mysqli_num_rows($pagi_query);
    $total_page = ceil($total_users/$item_per_page);

    $output.="<tbody><tr><td colspan='6' align='center'><ul class='pagination admin-pagination'>";
    for($p=1; $p<=$total_page; $p++){
        if($p == $page){
            $active = 'active';
        }else{
            $active = '';
        }
        $output.="<li class='{$active}' id='{$p}'><a>{$p}</a></li>";
    }
    $output.="</ul></td><tr></tbody>";

}else{
    $output .= "<tr><td colspan='6'><h3>Users Not Found</h3></td></tr>";
}
echo $output;