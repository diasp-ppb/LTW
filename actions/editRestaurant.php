<?php
if(isset($_POST['Edit'])){
    $id = htmlentities($_POST['id']);
    $name = htmlentities($_POST['name']);
    $address = htmlentities($_POST['address']);
    $city = htmlentities($_POST['city']);
    $district = htmlentities($_POST['district']);
    $country = htmlentities($_POST['country']);
    $type = htmlentities($_POST['type']);
    $description = htmlentities($_POST['description']);

    include_once '../Database/Connect.php';

    $update = $db->prepare("UPDATE Restaurants SET name = '$name', address = '$address', city = '$city', district = '$district',
        country = '$country', type = '$type', description = '$description'
        WHERE rowid = $id");

        try{
            $update->execute();
        }catch (PDOException $e) {
            echo 'Error updating';
        }

        echo'EDITED';
    }

    $link = "../pages/restaurant.php?id=".$id;
    header('Location:' . $link);
?>
