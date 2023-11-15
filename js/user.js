$(document).ready(function () {
    const domain = "http://localhost/php_project/php-ajax-news-site/";
    // Load/Show Users to Admin
    function loadUsers(pageNo) {
        $("#load-user").html("");
        $.ajax({
            type: "POST",
            data: {pageNo: pageNo},
            url: domain+"admin/inc/user/load-users.php",
            success: function (response) {
                $("#load-user").fadeIn().append(response);
            }
        });
    }
    loadUsers();

    // Users Pagination
    $(document).on("click", ".pagination li", function(){
        var pageId = $(this).text();
        loadUsers(pageId);
    })

    // Modal Close
    $(document).on("click","#close-btn",function(){
        $("#modal").fadeOut();
        // $(".add_user_modal").fadeOut().hide();
        $(".add_user_modal").fadeOut();
    });


    // Insert User
    $(document).on("click","#add-new-user",function(e){
        e.preventDefault();
        $(".add_user_modal").fadeIn();
        
        $("#save_user").submit(function(e){
            e.preventDefault();
            $("#load-user").html("");
            var userData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: domain+"admin/inc/user/add-user.php",
                data: userData,
                success: function (response) {
                    console.log(response)
                    if(response == 1){
                        $(".add_user_modal").fadeOut();
                        loadUsers();
                        alert("User Insert Successfully");
                        $("#save_user").trigger("reset");
                    }else{
                        alert("User Can't Insert");
                    }
                }
            });
        });
    
        
    });
    
    // Load User on User Modal
    $(document).on("click",".edit_user",function(e){
        e.preventDefault();
        $("#modal").fadeIn().show();
        var edit_id = $(this).data('eu_id');
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/user/update-user.php",
            data: {id: edit_id},
            success: function (response) {
                $("#user-modal").html(response);
            }
        });
    });

    // Update user From User Modal
    $("#user-modal").submit(function(e){
        e.preventDefault();
        var formData=$(this).serialize();
        $.ajax({
            type: "POST",
            url: domain+"admin/inc/user/save-user.php",
            data: formData,
            success: function (response) {
                if(response == 1){
                    alert("User Update Successfully");
                    loadUsers();
                    $("#modal").fadeOut();
                }else{
                    alert("User Can't Update");
                    $("#modal").fadeOut();
                }
            }
        });
    });


    // Delete User
    $(document).on("click",".delete_user",function(e){
        e.preventDefault();
        if(confirm("Are you want to sure delete this user?")){
            var del_id = $(this).data('du_id');
            var element = this;
            $.ajax({
                type: "POST",
                url: domain+"admin/inc/user/delete-user.php",
                data: {id: del_id},
                success: function (response) {
                    if(response == 1){
                        // alert("User Deleted Successfully");
                        $(element).closest("tr").hide();
                        // loadUsers();
                    }else{
                        alert("User Can't Delete");
                    }
                }
            });
        }
    });



});