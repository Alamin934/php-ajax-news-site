$(document).ready(function () {
    const domain = "http://localhost/php_project/php-ajax-news-site/";
    function load_category(page){
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/category/load-category.php",
            data: {page_no: page},
            success: function (response) {
                $("#load-category").html(response);
            }
        });
    }
    load_category();

    // Category Pagination
    $(document).on("click", ".pagination li a", function(e){
        e.preventDefault();
        var page_id = $(this).attr('id');
        load_category(page_id);
    });

    // Insert/Add New Category
    // Insert User
    $(document).on("click","#add-new-category",function(e){
        e.preventDefault();
        $(".addCatModal").fadeIn();
        
        $("#save_category").on("click",function(e){
            e.preventDefault();
            var cat_name = $("#add_cat_name").val();
            if(cat_name != ''){
                $.ajax({
                    type: "POST",
                    url: domain+"admin/inc/category/add-category.php",
                    data: {cat_name:cat_name},
                    success: function (response) {
                        if(response == 1){
                            $(".addCatModal").fadeOut();
                            load_category();
                            alert("Category Inserted Successfully");
                            $("#add_cat_name").val("");
                        }else{
                            alert("Category Can't Insert");
                            $(".addCatModal").fadeOut();
                        }
                    }
                });
            }else{
                alert("Fields is required");
            }
        });       
    });
    
    // Show Category Update Modal & Load/Show Category on Form
    $(document).on("click", ".edit_cat", function(e){
        e.preventDefault();
        $(".updateCatModal").fadeIn();
        var cat_id = $(this).data('ec_id');

        $.ajax({
            type: "POST",
            url: domain+"admin/inc/category/load-update-category.php",
            data: {id: cat_id},
            success: function (response) {
                $("#loadCatForm").html(response);
            }
        });
    });

    // Hide Category Modal
    $(document).on("click", "#close-btn", function(e){
        e.preventDefault();
        $(".updateCatModal").fadeOut();
    });

    // Update Category
    $(document).on("click", "#update_cat", function(e){
        e.preventDefault();
        var cat_id = $("#cat_id").val();
        var cat_name = $("#cat_name").val();
        
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/category/update-category.php",
            data: {c_id: cat_id, c_name: cat_name},
            success: function (response) {
                if(response == 1){
                    $(".updateCatModal").fadeOut();
                    alert("Category Updated Successfully");
                    load_category();
                }else{
                    $(".updateCatModal").fadeOut();
                    alert("Category Can't Updated");
                }
            }
        });
    });

    // Delete Category
    $(document).on("click",".delete_cat",function(e){
        e.preventDefault();
        if(confirm("Are you want to sure delete this Category?")){
            var del_id = $(this).data('dc_id');
            var element = this;
            $.ajax({
                type: "POST",
                url: domain+"admin/inc/category/delete-category.php",
                data: {id: del_id},
                success: function (response) {
                    if(response == 1){
                        alert("Category Deleted Successfully");
                        $(element).closest("tr").slideUp();
                        load_category();
                    }else{
                        alert("Category Can't Delete");
                    }
                }
            });
        }
    });



});