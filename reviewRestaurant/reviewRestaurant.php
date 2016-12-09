<!DOCTYPE html>
<html>

<head>
    <title>Já Comia - Review Restaurant</title>
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

        ?>
    </div>


    <div id="review">
        <form action="reviewRestaurant.php" method="get">
            <?php
                $id = $_GET['id'];
                echo '<input type="text" id="restID" name="id" value="' . $id . '"  >';
            ?>
            <input type="text" name="title" placeholder="Title"/>
            <input type="msg" name="comment" placeholder="Comment"/>
            <input type="range" name="classification" min="1" max="5">
            <input type="submit" name="Submit" value="Submit">
        </form>

    </div>

    <?php
        if(isset($_GET['Submit'])){
            $id = $_GET['id'];
            $title = $_GET['title'];
            $comment = $_GET['comment'];
            $classification = $_GET['classification'];

            include_once '../Database/Connect.php';

            $insert = $db->prepare("INSERT INTO Reviews (userID, restaurant, title, opinion, classification)
                       VALUES (1,'$id','$title','$comment','$classification');"); //TODO - change userID


            try {
                $query->execute();
                header('Location: thankyou.php');
            } catch (PDOException $e) {
                echo 'Fail inserting review!';
            }
        }
    ?>

</body>
