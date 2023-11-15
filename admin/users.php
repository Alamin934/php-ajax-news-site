<?php include "header.php"; 

if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}
?>
<div id="admin-content">
    <div class="container">
            <!-- User Update/Edit Modal Box -->
        <div class="row"  id="modal">
            <div class="" id="modal-form">
                <h1 class="admin-heading">Modify User Details</h1>
                <!-- Form Start -->
                <form  action="" method ="POST" id="user-modal"></form>
                <!-- /Form -->
                <div id="close-btn">X</div>
            </div>
        </div>
        <!-- Add New User Modal -->
        <div class="row add_user_modal" id="modal">
            <div class="col-md-12" id="modal-form">
                <h1 class="admin-heading">Add User</h1>
                <div class="">
                    <!-- Form Start -->
                    <form  action="" method ="POST" id="save_user" autocomplete="off">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                        </div>
                            <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="user" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label>User Role</label>
                            <select class="form-control" name="role" >
                                <option value="0">Normal User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                    </form>
                    <!-- Form End-->
                    <div id="close-btn">X</div>
                </div>
            </div>
        </div>

        <!-- Load Users -->
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" id="add-new-user" href="">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table" id="load-user"></table>
            </div>
        </div>
        

    </div>
</div>
<?php include "footer.php"; ?>
