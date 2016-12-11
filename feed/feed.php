
<?php include_once('../templates/header.php') ?>
<body>

    <?php include_once('../templates/topbar.php') ?>

    <div id="main">
        <img src="../resources/mainimg.gif"/>
        <div id="maincontent">
            <h1>Já Comia</h1>
            <div id="mainsearch"/>
            <form action="feed.php" method="get">
                <?php
                $rname = $_GET['rname'];
                $local = $_GET['local'];

                echo '<input type="text" name="rname" placeholder="Restaurant" value="' . $rname . '">';
                echo '<input type="text" name="local" placeholder="Location" value="' . $local . '">';
                ?>
                <input type="submit" value="">
            </form>
        </div>
    </div>
</div>

<div id="restaurantslist">
    <?php
    $rname = $_GET['rname'];
    $local = $_GET['local'];
    $search = $_GET['search'];

    include_once('../Database/Connect.php');



    $stmt;

    if($rname == '' && $local == '' && $search == '')
    $stmt = $db->prepare("SELECT *,rowid FROM Restaurants ORDER BY avgClass DESC");
    else if ($search != '')
    $stmt = $db->prepare("SELECT *,rowid FROM Restaurants WHERE name = '$search' OR city = '$search' OR district = '$search' OR country = '$search' ORDER BY avgClass DESC");
    else
    $stmt = $db->prepare("SELECT *,rowid FROM Restaurants WHERE name = '$rname' OR city = '$local' OR district = '$local' OR country = '$local' ORDER BY avgClass DESC");

    $stmt->execute();
    $result = $stmt->fetchAll();


    foreach ($result as $row)
    {
        $link = "../restaurant/restaurant.php?id=" . $row['rowid'];

        echo  '<div class="restaurant">';

        echo '<img src="../resources/rex.jpg">';

        echo '<h1>' . '<a href=' . $link . '>' . $row['name'] . '</a>' . '</h1>';

        echo '<h2>' . $row['city'] , ", " , $row['district'], ", ", $row['country']  . '</h2>';
 
        echo '<p>' .  $row['description'] . '</p>';

        echo '<div class="rrating">';
        if($row['avgClass'] != NULL)
        echo '<p>' . $row['avgClass'], "/5" . '</p>';
        else
        echo '<p>  Nan </p>';

        echo '</div>';

         $rounded = round($row['avgClass']);

        if($rounded <= 1)
        echo '<div class="rstars" style="margin-left: 910px;">';
        else if($rounded <= 2)
        echo '<div class="rstars" style="margin-left: 900px;">';
        else if($rounded <= 3)
        echo '<div class="rstars" style="margin-left: 890px;">';
        else if($rounded <= 4)
        echo '<div class="rstars" style="margin-left: 880px;">';
        else if($rounded <= 5)
        echo '<div class="rstars" style="margin-left: 875px;">';

        

        for($i = 0; $i < $rounded ; $i++)
        echo '<img style="width:20px; height:18px;" src="../resources/star.png">';
    
        echo '</div>';


        echo '</div>';


    }
    ?>

</div>



</body>

<?php  include_once('../templates/footer.php') ?>
