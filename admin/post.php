<?php include "header.php"; 
if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" id="add-post" href="">add post</a>
            </div>
            <div class="col-md-12" id="load-post">
                
            </div>
        </div>

        <!-- Post Pop up Modals Start -->

        <!-- Add Post Modal -->
        <div class="row addPostModal" id="modal">
            <div id="modal-form">
                <h1 class="admin-heading">Add New Post</h1>
                <div>
                    <!-- Form Start -->
                    <form  action="" id="submit-post" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="post_title">Title</label>
                            <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> Description</label>
                            <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Category</label>
                            <select id="category" name="category" class="form-control">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Post image</label>
                            <input type="file" name="fileToUpload" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Save" required />
                    </form>
                    <!-- /Form End -->
                    <div id="close-btn">X</div>
                </div>
            </div>
        </div>

        <!-- Update Post Modal -->
        <div class="row updatePostModal" id="modal">
            <div id="modal-form">
                <h1 class="admin-heading"> Update Category</h1>
                <div>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="form-group">
                            <input type="hidden" name="post_id"  class="form-control" value="1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputTile">Title</label>
                            <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="Lorem ipsum dolor sit amet">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1"> Description</label>
                            <textarea name="postdesc" class="form-control"  required rows="5">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCategory">Category</label>
                            <select class="form-control" name="category">
                                <option value="">Html</option>
                                <option value="">Css</option>
                                <option value="">javascript</option>
                                <option value="">Python</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Post image</label>
                            <input type="file" name="new-image">
                            <img  src="" height="150px">
                            <input type="hidden" name="old-image" value="">
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                    </form>
                    <div id="close-btn">X</div>
                </div>
            </div>
        </div>
        <!-- Category Pop up Modals End -->
    </div>
</div>
<?php include "footer.php"; ?>
