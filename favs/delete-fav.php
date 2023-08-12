<?php
    require "../config/config.php";


    if(isset($_GET['property_id']) AND isset($_GET['user_id'])){
        $property_id = $_GET['property_id'];
        $user_id = $_GET['user_id'];

        $delete = $conn->query("DELETE  FROM favs WHERE property_id ='$property_id' AND user_id = '$user_id'");
        $delete->execute();

        echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/property-details.php?id='.$property_id.'">';

    
  }else{
    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/404.php">';

}

    ?>