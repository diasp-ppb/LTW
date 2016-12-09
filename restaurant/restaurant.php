<!DOCTYPE html>
<html>

<head>
    <title>Já Comia - Restaurant</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

</head>


<body>

    <?php
        include_once('../templates/topbar.php');
    ?>

    <div id="main">
        <?php
        if(!isset($_GET['id']))
            header('Location:  ../feed/feed.php');
        else
            $id = $_GET['id'];


        $db = new PDO('sqlite:../Database/dataBase.db');

        $query = $db->prepare("SELECT *, rowid FROM Restaurants WHERE rowid = '$id'");
        $query->execute();
        $result = $query->fetchAll();

        $result = $result[0];

        echo '<img src="../resources/rex.jpg">';

        echo '<h1>' . $result['name'] . '</h1>';

        echo '<h2>' . $result['city'] , ", " , $result['district'], ", ", $result['country']  . '</h2>';

        echo '<div class="avgClass"> <h2>' . $result['avgClass'], "/5" .  '</h2> </div>';

        echo '<p> Type: ' .  $result['type'] . '</p>';

        $reviewLink = "../reviewRestaurant/reviewRestaurant.php?id=" . $id;

        echo '<a href="' . $reviewLink . '">Review this Restaurant </a>';

        ?>
    </div>

    <div id="reviews">
        <?php
        //SELECT * FROM Reviews JOIN Restaurants ON (Restaurants.rowID = Reviews.restaurant) JOIN Users ON (Users.rowID = Reviews.userID);
        $db = new PDO('sqlite:../Database/dataBase.db');
        $query = $db->prepare("SELECT * FROM Reviews JOIN Restaurants ON (Restaurants.rowID = Reviews.restaurant)
                                                            JOIN Users ON (Users.rowID = Reviews.userID)
                                                            WHERE Restaurants.rowID = '$id'");
        $query->execute();
        $result = $query->fetchAll();


        foreach ($result as $row) {
            echo '<div class="review">';
            echo '<p>' . $row['usr'] . '</p>';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<p>' . $row['opinion'] . '</p>';
            echo '<p class="revClass">' . $row['classification'],"/5" . '</p>';
            echo '</div>';
            echo '<hr>';
        }

        ?>
    </div>



</body>


</html>
