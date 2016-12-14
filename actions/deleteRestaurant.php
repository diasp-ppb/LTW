<?php
    include_once("../Database/Connect.php");

    $name = $_POST['name'];
    $street = $_POST['street'];
    $district = $_POST['district'];
    $country = $_POST['country'];

    $getrestaurantid = $db->prepare("SELECT rowid FROM Restaurants WHERE name='$name' AND address='$street' AND district = '$district' AND country = '$country';");
    try {
        $getrestaurantid->execute();
    } catch (PDOException $e) {
    }

    $results = $getrestaurantid->fetchAll();
    $id = $results[0]['rowid'];

    echo $id;


    $deleteRestaurant = $db->prepare("DELETE FROM Restaurants WHERE rowid ='$id';");
    $deleteRestaurant->execute();

    //Reviews
    $deleteReviews = $db->prepare("DELETE FROM Reviews WHERE restaurant = '$id';");
    $deleteReviews->execute();


    //Owners
    $deleteOwners = $db->prepare("DELETE FROM Owners WHERE restaurant = '$id';");
    $deleteOwners->execute();

    //images
    $deleteImages = $db->prepare("DELETE FROM Images WHERE restaurant = '$id';");
    $deleteImages->execute();

    header('Location: ../pages/admin.php');
?>
