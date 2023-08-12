<?php 
    require "../../config/config.php";

 

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //deleting thumbnails
        $query = $conn->query("SELECT * FROM properties WHERE id = '$id'");
        $query->execute();
        $fetch_image = $query->fetch(PDO::FETCH_OBJ);

        unlink("images/".$fetch_image->image);

        //deleting properties record
        $delete = $conn->query("DELETE FROM properties WHERE id = '$id'");
        $delete->execute();

        //deleting images
        $images = $conn->query("SELECT * FROM relatedimages WHERE property_id = '$id'");
        $images->execute();
        $delete_images = $images->fetchAll(PDO::FETCH_OBJ);

        foreach($delete_images as $delete_image){
            unlink("thumbnails/".$delete_image->image);

        }

         //deleting related_images
         $delete_related_images = $conn->query("DELETE FROM relatedimages WHERE property_id = '$id'");
         $delete_related_images->execute();

        echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/admin-panel/properties-admins/show-properties.php">';

    }else{
        echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/404.php">';

    }
