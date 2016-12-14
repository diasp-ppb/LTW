<!DOCTYPE html>
<html>

<?php
    include_once('../templates/header.php');
    include_once('../templates/topbar.php');
?>

<head>
    <title>Já Comia - Restaurant</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/restaurant.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../templates/footer.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <script src="../scripts/searchMap/l.control.geosearch.js"></script>
    <script src="../scripts/searchMap/l.geosearch.provider.openstreetmap.js"></script>
    <script src="../scripts/restaurantMap.js"></script>
    <script src="../scripts/restaurant.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.1/galleria.min.js"></script>
</head>

<body>
    <div id="main">
        <?php
            if(!isset($_GET['id']))
            header('Location:  ../feed/feed.php');
            else
            $id = $_GET['id'];


            include_once("../Database/Connect.php");

            if(isset($_SESSION["user"])){




                $queryUser = $_SESSION["user"];


                $isOwner = $db->prepare("SELECT * FROM Owners  JOIN Restaurants ON Owners.restaurant = Restaurants.rowID JOIN Users ON Users.rowID = Owners.owner WHERE Users.usr = '$queryUser' AND Restaurants.rowID = '$id'");
                $isOwner->execute();

                $isOwnerResult = $isOwner-> fetchAll();



                if(count($isOwnerResult) <= 0)
                $owner = False;
                else
                $owner = True;



            }



            $query = $db->prepare("SELECT *, rowid FROM Restaurants WHERE rowid = '$id'");
            $query->execute();
            $result = $query->fetchAll();

            $result = $result[0];

            $imagequery = $db->prepare("SELECT * FROM Images WHERE restaurant = '$id';");
            try {
                $imagequery->execute();
            } catch (PDOException $e){
            }

            $rating = $result['avgClass'];
            $rating = round($rating, 1);

            $image;
            $images = $imagequery->fetchAll();
            if(!isset($images[0]))
            $image = "../resources/rex.jpg";
            else
            $image = $images[0]['name'];

            //echo '<img src="'. $image .'">';
            echo '<div class="galleria">';
            if(count($images) == 0)
                echo '<img src="' . $image . '">';
            else{
                foreach($images as $row)
                    echo '<img src="' . $row['name'] . '">';
            }
            /*f
            <img src="'. $image . '">*/
            echo '</div>';

            echo '<h1>' . $result['name'] . '</h1>';

            echo '<h2>' . $result['address'] . '</h2>';

            echo '<h2>' . $result['city'] , ", " , $result['district'], ", ", $result['country']  . '</h2>';

            echo '<div class="avgClass"> <h2>' . $rating, "/5" .  '</h2> </div>';

            echo '<p> Type: ' .  $result['type'] . '</p>';

            $reviewLink = "../pages/reviewRestaurant.php?id=" . $id;


            if(isset($_SESSION["user"])){
                if(!($owner)){
                    echo '<a href="' . $reviewLink . '">Review this Restaurant </a>';
                }
                else
                    echo '<a href="#" onclick="changeEdit();"> Edit Restaurant </a>';
                ?>
                <form id="addForm" action="../actions/addPhoto.php" method="post" enctype="multipart/form-data">
                    <?php
                        echo '<input style="display:none;" type="text" name="id" value="' . $id . '">';
                    ?>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" name="AddPhoto" value="Add Photo" id="submitPhoto">
                </form>
                <?php
            }


            echo '<div id="mapid">';

            echo '<p id="restloc">' . $result['address'] . ', ' .  $result['city'] . ', ' . $result['country'] . '</p>';

            echo '</div>';

            if($owner){
                echo '<div id="editRestaurant">';
                echo '<p>Edit this restaurant: </p>';

                echo '<form action="../actions/editRestaurant.php"  method="post">';
                echo '
                <input type="text" name="id" value=" '. $id . '">
                <label> Nome </label>
                <input type="text" name="name" value="'.$result['name'].'"required >
                <label> Rua </label>
                <input type="text" name="address" value="'.$result['address'].'"required>
                <label> Cidade </label>
                <input type="text" name="city" value="'.$result['city'].'"required>
                <label> Distrito </label>
                <input type="text" name="district" value="'.$result['district'].'"required>
                <label> País </label>
                <input type="text" name="country" value="'.$result['country'].'"required>
                <label> Tipo </label>
                <input type="text" name="type" value="'.$result['type'].'" required>
                <label> Descrição </label>
                <textarea name="description" maxlength="1024" >'. $result['description'] . '</textarea>

                <input type="submit" name="Edit" value="Submit">
                ';


                echo '</form>';
            }

            ?>


            <?php
            if($owner)
            {
                echo '<form action="../actions/editPhoto.php" method="post" enctype="multipart/form-data">';
                echo '<input style="display:none;" type="text" name="id" value=" '. $id . '">';
                echo '<input type="file" name="fileToUpload" id="fileToUpload">';
                echo '<input type="submit" name="EditPhoto" value="editPhoto">';
                echo '</form>';

                echo '</div>';
            }
            ?>
            <script>
            (function() {
                Galleria.loadTheme('https://cdnjs.cloudflare.com/ajax/libs/galleria/1.5.1/themes/classic/galleria.classic.min.js');
                Galleria.run('.galleria');
            }());
            </script>

        </div>

        <div id="reviews">
            <?php
            include_once '../Database/Connect.php';
            $query = $db->prepare("SELECT *, Reviews.rowID FROM Reviews JOIN Restaurants ON (Restaurants.rowID = Reviews.restaurant)
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


                $reviewID = $row['rowid'];


                $reply = $db->prepare("SELECT *,rowID FROM ReviewComments WHERE review =  $reviewID ");

                $reply->execute();

                $replyResult = $reply->fetchAll();

                if(count($replyResult) <= 0) {
                    //E SE NAO TIVER resposta
                    if($owner){
                        echo '
                        <div id="replyReview">
                        <form action="../actions/reply.php" method="post">
                        <textarea name="replyText" maxlength="512" placeholder="Deixa um comentário..." required></textarea>
                        <input type="hidden" name="review" value="'.$row['rowid'].'"/>
                        <input type="hidden" name="ID" value="'.$id.'"/>
                        <input type="submit" name="Reply" value="Comentar">
                        </form>
                        </div>';
                    }

                }else{

                    //SE TIVER RESPOSTA

                    $opinion = $replyResult[0]['opinion'];
                    echo '<div id="replyReview">
                    <h3> A gerencia </h3>
                    <p>'.$opinion.'</p>
                    </div>
                    ';

                }

                echo '</div>';
                echo '<hr>';
            }

            ?>
        </div>

        </body>



        <?php  include_once('../templates/footer.php') ?>
