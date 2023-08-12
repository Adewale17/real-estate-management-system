<?php 
    require "../../config/config.php";

    if (!isset($_SESSION['username'])) {
        echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/admins/login-admins.php">';
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];


        $delete = $conn->query("DELETE FROM categories WHERE id = '$id'");
        $delete->execute();

        echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/categories-admins/show-categories.php">';

    }else{
        echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/404.php">';

    }
