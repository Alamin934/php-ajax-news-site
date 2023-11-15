<?php
include "inc/config.php";
session_start();
if(!isset($_SESSION['user_name'])){
    header("Location: {$hosturl}/admin");
}
?>
<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <span>© Copyright 2019 News | Powered by <a href="http://yahoobaba.net/">Yahoo Baba</a></span>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
<script src="../js/jquery-3.7.1.min.js"></script>
<script src="../js/user.js"></script>
<script src="../js/category.js"></script>
<script src="../js/post.js"></script>
</body>
</html>
