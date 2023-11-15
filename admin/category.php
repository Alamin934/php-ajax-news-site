<?php 
include "header.php";
include "inc/config.php";

if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" id="add-new-category" href="">add category</a>
            </div>
            <!-- Display Category -->
            <div class="col-md-12" id="load-category">

            </div>
        </div>


        <!-- Category Pop up Modals Start -->

        <!-- Add Category Modal -->
        <div class="row addCatModal" id="modal">
            <div id="modal-form">
                <h1 class="admin-heading">Add New Category</h1>
                <div>
                    <!-- Form Start -->
                    <form action="" method="POST" autocomplete="off">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" id="add_cat_name" class="form-control" placeholder="Category Name" required>
                        </div>
                        <input type="submit" id="save_category" class="btn btn-primary" value="Save" required />
                    </form>
                    <!-- /Form End -->
                    <div id="close-btn">X</div>
                </div>
            </div>
        </div>

        <!-- Update Category Modal -->
        <div class="row updateCatModal" id="modal">
            <div id="modal-form">
                <h1 class="admin-heading"> Update Category</h1>
                <div>
                    <form action="" method ="POST" id="loadCatForm">
                        
                    </form>
                    <div id="close-btn">X</div>
                </div>
            </div>
        </div>
        <!-- Category Pop up Modals End -->
    </div>
</div>

<?php include "footer.php"; ?>
