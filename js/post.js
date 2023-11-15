$(document).ready(function () {
    const domain = "http://localhost/php_project/php-ajax-news-site/";
    // Load/Show All Posts
    function load_post(page){
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/post/load-post.php",
            data: {page_no: page},
            success: function (response) {
                $("#load-post").html(response);
            }
        });
    }
    load_post();

    // Post pagination
    $(document).on("click", ".pagination li a", function(e){
        e.preventDefault();
        var page_id = $(this).attr('id');
        load_post(page_id);
    });

    // Show Modal
    $(document).on("click", "#add-post", function(e){
        e.preventDefault();
        $(".addPostModal").fadeIn();
        // Load category for post insert
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/post/add-post.php?action=cat",
            success: function (response) {
                if(response){
                    $(".addPostModal form #category").html(response);
                }
            }
        });

    });
    
    // Add/Insert Post to DB
    $("#submit-post").submit(function(e){
        e.preventDefault();
        var postData = new FormData(this);;
        
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/post/add-post.php?action=post",
            data: postData,
            contentType: false,
            processData: false,
            success: function (post) {
                if(post == 1){
                    $(".addPostModal").fadeOut();
                    load_post();
                    $(this).trigger("reset");
                    alert("Post Inserted Sucessfully");
                }
            }
        });
    });
    


    // Show Modal Update Post
    $(document).on("click", "#edit-post", function(e){
        e.preventDefault();
        $(".updatePostModal").fadeIn();
        const edit_id = $(this).data("ep_id");
        // Load Post for update   
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/post/load-update-post.php",
            data: {id: edit_id},
            success: function (response) {
                if(response){
                    $("#loadPostForm").html(response);
                }
            }
        });

        
    });

    // Update Post
    $(".update_post").submit(function(e){
        e.preventDefault();
        var postForm =new FormData(this);
        var old_cat = $("#old_post_cat").val();
        $.ajax({
            type: "POST",
            url: `${domain}admin/inc/post/update-post.php?old_cat=${old_cat}`,
            data: postForm,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response == 1){
                    alert("Post Update Successfully");
                    load_post();
                    $(".updatePostModal").fadeOut();
                }else{
                    alert("Post Can't Update");
                }
            }
        });
    });

    // Hide Modal
    $(document).on("click", "#close-btn",function(){
        $(".addPostModal").fadeOut();
        $(".updatePostModal").fadeOut();
    });

    // Delete Post
    $(document).on("click", "#delete-post", function(e){
        e.preventDefault();
        const del_id = $(this).data("dp_id");
        var element = this;
        if(confirm("Are you want to sure Delete this Post?")){
            $.ajax({
                type: "POST",
                url: domain+"admin/inc/post/delete-post.php",
                data: {id: del_id},
                success: function (response) {
                    if(response == 1){
                        load_post();
                        alert("Post Deleted Successfully");
                        $(element).closest("tr").hide();
                    }else{
                        alert("Post Can't Deleted");
                    }
                }
            });
        }

    });



});