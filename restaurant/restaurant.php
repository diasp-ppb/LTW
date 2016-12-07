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
        $id = $_GET['id'];

        $db = new PDO('sqlite:../Database/dataBase.db');

        $stmt = $db->prepare("SELECT *, rowid FROM Restaurants WHERE rowid = '$id'");
        $stmt->execute();
        $result = $stmt->fetchAll();

        $result = $result[0];

        echo '<img src="../resources/rex.jpg">';

        echo '<h1>' . $result['name'] . '</h1>';

        echo '<h2>' . $result['city'] , ", " , $result['district'], ", ", $result['country']  . '</h2>';

        echo '<div class="avgClass"> <h2>' . $result['avgClass'], "/5" .  '</h2> </div>';

        echo '<p> Type: ' .  $result['type'] . '</p>';
        ?>
    </div>



</body>


</html>
