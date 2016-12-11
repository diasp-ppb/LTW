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

        echo '<h2>' . $result['address'] . '</h2>';

        echo '<h2>' . $result['city'] , ", " , $result['district'], ", ", $result['country']  . '</h2>';

        echo '<div class="avgClass"> <h2>' . $result['avgClass'], "/5" .  '</h2> </div>';

        echo '<p> Type: ' .  $result['type'] . '</p>';

        $reviewLink = "../reviewRestaurant/reviewRestaurant.php?id=" . $id;

        echo '<a href="' . $reviewLink . '">Review this Restaurant </a>';

        echo '<div id="mapid">';
        echo '<p id="restloc">' . $result['address'] . ', ' .  $result['city'] . ', ' . $result['country'] . '</p>';

        echo '</div>';

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
