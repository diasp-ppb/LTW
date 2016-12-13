<?php
include_once("../Database/Connect.php");
include_once("../templates/uploadImage.php");

$id = $_POST['id'];
if(uploadImage()){
    $image = $_FILES['fileToUpload']['name'];
    $image = "../resources/uploads/" . $image;

    $insert = $db->prepare("INSERT INTO Images (restaurant, name) VALUES ('$id', '$image')");
    $insert->execute();
}

$link =  "restaurant.php?id=" . $id;
header('Location:'. $link);

?>
