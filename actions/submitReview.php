<?php
if (isset($_POST['Submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $comment = $_POST['comment'];
    $classification = $_POST['classification'];

    include_once '../Database/Connect.php';
    include_once '../templates/getUserID.php';

    $userid =  getUserID();

    $insert = $db->prepare("INSERT INTO Reviews (userID, restaurant, title, opinion, classification)
                            VALUES ('$userid','$id','$title','$comment','$classification');");

    try {
        $insert->execute();
    } catch (PDOException $e) {
    }

    header('Location: ../pages/restaurant.php?id='.$id);
}
