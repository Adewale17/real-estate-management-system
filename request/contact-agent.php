<?php
require "../config/config.php";

if(isset($_POST['submit'])) {
    

    if (empty($_POST["name"]) or empty($_POST["email"]) or empty($_POST["phone"])) {
        echo "<script>alert('One or more column is empty');</script>";
       echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/">';
    } else {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $property_id = $_POST['property_id'];
    $user_id = $_POST['user_id'];
    $admin_name = $_POST['admin_name'];

    
    $insert = $conn->prepare("INSERT INTO requests (name, email, phone, property_id, user_id, admin_name) 
    VALUES (:name, :email, :phone, :property_id, :user_id, :admin_name)");
    $insert->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':property_id'=>$property_id,
        ':user_id'=>$user_id,
        ':admin_name'=>$admin_name,

    ]);
    echo "<script>alert('Message sent successfully');</script>";
    echo '<meta http-equiv="refresh" content="0;url=http://localhost/homeland/property-details.php?id='.$property_id.'">';
    
    }
}
?>
