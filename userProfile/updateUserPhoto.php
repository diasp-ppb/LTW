<?php
session_start();
if(isset($_SESSION['user'])){

    include_once '../templates/getUserID.php';
    include_once '../templates/uploadImage.php';
    include_once '../Database/Connect.php';
    $userid = getUserID();

    if(uploadImage()){

        $imageurl = "../resources/uploads/" . $_FILES['fileToUpload']['name'];
        echo $imageurl;

        try{
        $update = $db->prepare("UPDATE Users SET photo = '$imageurl' WHERE rowid = '$userid';");
        $update->execute();
        }  catch(PDOException $Exception)
        {
            echo $Exception;
        }

    }


    header("Location: userProfile.php");
}

?>
