<!DOCTYPE html>
<html>

<head>
    <title>Já Comia - Restaurant</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
    <script src="../templates/searchMap/l.control.geosearch.js"></script>
    <script src="../templates/searchMap/l.geosearch.provider.openstreetmap.js"></script>
    <script>

    function loadMap(){
        var mymap = L.map('mapid').setView([51.505, -0.09], 13);
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18,
        }).addTo(mymap);

        var search = new L.Control.GeoSearch({
            provider: new L.GeoSearch.Provider.OpenStreetMap()
        }).addTo(mymap);

        var local = document.getElementById('restloc').innerHTML;
        search.geosearch(local);

    }
    window.onload = loadMap;
    </script>
    <script src="restaurant.js"></script>

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

        if(isset($_SESSION["user"])){



            include_once("../Database/Connect.php");

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

        $image;
        $images = $imagequery->fetchAll();
        if(!isset($images[0]))
            $image = "../resources/rex.jpg";
        else
            $image = $images[0]['name'];


        echo '<img src="'. $image .'">';

        echo '<h1>' . $result['name'] . '</h1>';

        echo '<h2>' . $result['address'] . '</h2>';

        echo '<h2>' . $result['city'] , ", " , $result['district'], ", ", $result['country']  . '</h2>';

        echo '<div class="avgClass"> <h2>' . $result['avgClass'], "/5" .  '</h2> </div>';

        echo '<p> Type: ' .  $result['type'] . '</p>';

        $reviewLink = "../reviewRestaurant/reviewRestaurant.php?id=" . $id;


        if(isset($_SESSION["user"])){
            if(!($owner)){
            echo '<a href="' . $reviewLink . '">Review this Restaurant </a>';
            }
        }


        if($owner)
        echo '<div class="edit"><a href="#" onclick="changeEdit();"> Edit Restaurant </a></div>';


        echo '<div id="mapid">';
        
        echo '<p id="restloc">' . $result['address'] . ', ' .  $result['city'] . ', ' . $result['country'] . '</p>';

        echo '</div>';

        if($owner){
        echo '<div id="editRestaurant">';
        echo '<p>Edit this restaurant: </p>';

        echo '<form action="restaurant.php"  method="post">';
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
          <textarea name="description" maxlength="1024" required>'. $result['description'] . '</textarea>

        <input type="submit" name="Edit" value="Submit">
        ';


        echo '</form>';
        echo '</div>';
        }

        ?>
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
                //E SE NAO TI VER resposta
                    if($owner){
                      echo '
                      <div id="replyReview">
                        <form action="reply.php" method="post">
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

    <?php
        if(isset($_POST['Edit'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $district = $_POST['district'];
            $country = $_POST['country'];
            $type = $_POST['type'];
            $description = $_POST['description'];

            include_once '../Database/Connect.php';

            $update = $db->prepare("UPDATE Restaurants SET name = '$name', address = '$address', city = '$city', district = '$district',
                                                           country = '$country', type = '$type', description = '$description'
                                                           WHERE rowid = $id");

            try{
                $update->execute();
            }catch (PDOException $e) {
                echo 'Error updating';
            }


        }

    ?>


</body>


</html>
