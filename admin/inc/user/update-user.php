<?php 
include "../config.php";

$edit_id = $_POST['id'];

$user_sql = "SELECT user_id,username,first_name,last_name,role FROM user WHERE user_id = {$edit_id}";
$user_query = mysqli_query($conn, $user_sql) or die("Load user query failed");

if(mysqli_num_rows($user_query)>0){
    while($user = mysqli_fetch_assoc($user_query)){
        if($user['role']==0){
            $user_role = "<option selected value='0'>User</option><option value='1'>Admin</option>";
        }else{
            $user_role = "<option value='0'>User</option><option selected value='1'>Admin</option>";
        }

       echo "<div class='form-group'>
                <input type='hidden' name='user_id' value='{$user['user_id']}'  class='form-control' >
            </div>
            <div class='form-group'>
                <label>First Name</label>
                <input type='text' name='first_name' value='{$user['first_name']}' class='form-control' required>
            </div>
            <div class='form-group'>
                <label>Last Name</label>
                <input type='text' name='last_name' value='{$user['last_name']}' class='form-control' required>
            </div>
            <div class='form-group'>
                <label>User Name</label>
                <input type='text' name='username' value='{$user['username']}' class='form-control' required>
            </div>
            <div class='form-group'>
                <label>User Role</label>
                <select class='form-control' name='role' value={$user['role']}''>
                    {$user_role}
                </select>
            </div>
            <input type='submit' name='update-user' class='btn btn-primary' value='Update' required />";
    }
}



