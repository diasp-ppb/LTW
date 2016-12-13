
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
                if(isset($_GET['rname'])){
                $rname = $_GET['rname'];
                $local = $_GET['local'];
                }
                else {
                    $rname = '';
                    $local = '';
                }

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
    if(isset($_GET['rname'])){
    $rname = $_GET['rname'];
    $local = $_GET['local'];
    }
    else if (isset($_GET['search']))
        $search = $_GET['search'];
    else{
        $rname = '';
        $local = '';
        $search = '';
    }
    include_once('../Database/Connect.php');



    $stmt;

    if($rname == '' && $local == '' && $search == '')
    $stmt = $db->prepare("SELECT *,rowid FROM Restaurants ORDER BY avgClass DESC");
    else if ($search != '')
    $stmt = $db->prepare("SELECT *,rowid FROM Restaurants WHERE name LIKE '%$search%' OR city LIKE '%$search%' OR district LIKE '%$search%' OR country LIKE '%$search%' ORDER BY avgClass DESC");
    else{
        if($rname != '' && $ $local == '')
            $stmt = $db->prepare("SELECT *,rowid FROM Restaurants WHERE name LIKE '%$rname%' ORDER BY avgClass DESC");
        else if ($rname == '' && $local != ' ')
            $stmt = $db->prepare("SELECT *,rowid FROM Restaurants WHERE city LIKE '%$local%' OR district LIKE '%$local%' OR country LIKE '%$local%' ORDER BY avgClass DESC");
        else
            $stmt = $db->prepare("SELECT *,rowid FROM Restaurants WHERE name LIKE '%$rname%' OR city LIKE '%$local%' OR district LIKE '%$local%' OR country LIKE '%$local%' ORDER BY avgClass DESC");
    }
//    $stmt = $db->prepare("SELECT *,rowid FROM Restaurants WHERE name LIKE '%$rname%' OR city LIKE '%$local%' OR district LIKE '%$local%' OR country LIKE '%$local%' ORDER BY avgClass DESC");

    $stmt->execute();
    $result = $stmt->fetchAll();


    foreach ($result as $row)
    {
        $restid = $row['rowid'];
        $link = "../restaurant/restaurant.php?id=" . $restid;

        $imagequery = $db->prepare("SELECT * FROM Images WHERE restaurant = '$restid';");
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

        echo  '<div class="restaurant">';

        echo '<img src="' . $image . '">';

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
