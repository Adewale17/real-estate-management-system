<?php
require "../config/config.php";

if(isset($_POST['submit'])) {
    $property_id = $_POST['property_id'];
    $user_id = $_POST['user_id'];

    $insert = $conn->prepare("INSERT INTO favs (property_id, user_id) VALUES (:property_id, :user_id)");
    $insert->execute([
        ':property_id' => $property_id,
        ':user_id' => $user_id,
    ]);

    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/property-details.php?id='.$property_id.'">';

}
?>
