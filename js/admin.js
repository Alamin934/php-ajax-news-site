$(document).ready(function () {
    const domain = "http://localhost/php_project/php-ajax-news-site/";

    $("#login").submit(function(e){
        e.preventDefault();
        const loginData = new FormData(this);

        $.ajax({
            type: "POST",
            url: domain+"admin/inc/login.php?action=login",
            data: loginData,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response == 0){
                    alert('All Fields must be entered');
                }else if(response == 2){
                    alert('Username and Password are not matched.');
                }else if(response == 3){
                    alert("Please Don't Cheat");
                }else if(response == 1){
                    window.location = domain+'admin/post.php';
                }
            }
        });
    });

});