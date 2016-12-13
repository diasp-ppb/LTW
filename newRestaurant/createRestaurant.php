<?php
 if (isset($_POST['submit'])) {
     $name = $_POST['name'];
     $address = $_POST['address'];
     $city = $_POST['city'];
     $district = $_POST['district'];
     $country = $_POST['country'];
     $type = $_POST['type'];

     include_once '../Database/Connect.php';
     include_once '../templates/uploadImage.php';
     include_once '../templates/getUserID.php';

     $query = $db->prepare("INSERT INTO Restaurants (name, address, type, city, district, country, avgClass)
                            VALUES ('$name','$address','$type','$city','$district','$country',NULL);");

     try {
         $query->execute();
     } catch (PDOException $e) {
     }

     $getid = $db->prepare("SELECT rowid FROM Restaurants WHERE name = '$name' AND address = '$address' AND country = '$country' AND type = '$type';");
     $getid->execute();
     $id = $getid->fetchAll();
     $id = $id[0];
     $num = $id['rowid'];
     $usernum = getUserID();

     $insertowner = $db->prepare("INSERT INTO Owners (owner, restaurant) VALUES('$usernum', '$num');");
     try {
         $insertowner->execute();
     } catch (PDOException $e) {
     }

     if (uploadImage()) {
         $imageurl = "../resources/uploads/" . $_FILES['fileToUpload']['name'];
         $insertimage = $db->prepare("INSERT INTO Images (restaurant, name) VALUES ('$num', '$imageurl');");
         $insertimage->execute();
     }
 }
