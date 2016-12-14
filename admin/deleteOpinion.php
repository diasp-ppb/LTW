<?php


 include_once('../Database/Connect.php');

 $name = $_POST['name'];
 $restaurant= $_POST['restaurant'];
 $classification = $_POST['classification'];

 $search = $db->prepare('SELECT * FROM Reviews
    JOIN Restaurants ON restaurant = Restaurants.rowid
    JOIN Users ON Users.rowid = Reviews.userID
    WHERE Users.usr = "'.$name.'"
    AND
    WHERE Restaurants.name ="'.$restaurant.'"
    AND Reviews.classification="'.$classification.'"
    ');


$search->execute();

$result = $search->fetchAll();


$result = $result[0];


$uID= $result['userID'];
$restID = $result['restaurant'];

$delete = $db->prepare('DELETE FROM REVIEWS WHERE userID ='.$userID.'
                            AND restaurant = '.$restID.'
                            AND classification ='.$classification.'');


?>