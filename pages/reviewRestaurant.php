<!DOCTYPE html>
<html>

<?php
    include_once('../templates/header.php');
    include_once('../templates/topbar.php');
?>

<head>
    <title>Já Comia - Review Restaurant</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/reviewRestaurant.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

</head>

<body>
    <div id="main">
        <?php
        if (!isset($_GET['id'])) {
            header('Location:  ../feed/feed.php');
        } else {
            $id = $_GET['id'];
        }

        include_once("../Database/Connect.php");

        $query = $db->prepare("SELECT *, rowid FROM Restaurants WHERE rowid = '$id'");
        $query->execute();
        $result = $query->fetchAll();

        if (count($result) != 1) {
            header('Location: ../feed/feed.php');
        }

        $result = $result[0];

        echo '<img src="../resources/rex.jpg">';
        echo '<h1>'.$result['name'].'</h1>';
        echo '<h2>'.$result['city'].", ".$result['district'].", ".$result['country'].'</h2>';
        echo '<div class="avgClass"> <h2>'.$result['avgClass']."/5".'</h2> </div>';
        echo '<p> Type: '.$result['type'].'</p>';
        ?>
    </div>

    <div id="review">
        <form action="../actions/submitReview.php" method="POST">
            <?php
            $id = $_GET['id'];
            echo '<input type="text" id="restID" name="id" value="'.$id.'"  >';
            ?>
            <input type="text" name="title" placeholder="Title (optional)" autocomplete="off" maxlength="64"/>
            <textarea name="comment" maxlength="1024" placeholder="Comment (optional)"></textarea>
            <span class="rating"> <!-- from: https://www.everythingfrontend.com/posts/star-rating-input-pure-css.html !-->
                <input type="radio" class="rating-input"
                    id="rating-input5" name="classification" value="5" required>
                <label for="rating-input5" class="rating-star"></label>
                <input type="radio" class="rating-input"
                    id="rating-input4" name="classification" value="4">
                <label for="rating-input4" class="rating-star"></label>
                <input type="radio" class="rating-input"
                    id="rating-input3" name="classification" value="3">
                <label for="rating-input3" class="rating-star" ></label>
                <input type="radio" class="rating-input"
                    id="rating-input2" name="classification" value="2">
                <label for="rating-input2" class="rating-star"></label>
                <input type="radio" class="rating-input"
                    id="rating-input1" name="classification" value="1">
                <label for="rating-input1" class="rating-star"></label>
            </span>
            <input type="submit" name="Submit" value="Submit">
        </form>

    </div>
</body>
