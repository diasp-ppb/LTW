<?php


 include_once('../Database/Connect.php');

 $name = $_POST['user'];
 $restaurant= $_POST['restaurant'];
 $classification = $_POST['class'];

 $search = $db->prepare("SELECT * FROM Reviews
    JOIN Restaurants ON restaurant = Restaurants.rowid
    JOIN Users ON Users.rowid = Reviews.userID
    WHERE Users.usr = '$name' AND
    Restaurants.name = '$restaurant'
    AND Reviews.classification='$classification'");


$search->execute();

$result = $search->fetchAll();

echo count($result);
$result = $result[0];


$uID= $result['userID'];
$restID = $result['restaurant'];

echo $uID;
echo $restID;
$delete = $db->prepare("DELETE FROM REVIEWS WHERE userID ='$uID'
                            AND restaurant = '$restID'
                            AND classification ='$classification'");
$delete->execute();

header('Location: admin.php');

?>
