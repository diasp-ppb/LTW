<?php


include_once('../templates/header.php');

?>

<body>
<?php include_once('../templates/topbar.php'); ?>
<div id="Intro">

<img src="../resources/imgNewRestaurant.jpg" />
<h1> Novo Restaurante <h1>
</div>

<div id="FormNewRestaurant">


<form action="newRestaurant.php"  method="get">

<?php

$name = $_GET['name'];
$address = $_GET['address'];
$city = $_GET['city'];
$district = $_GET['district'];
$country = $_GET['country'];
$type = $_GET['type'];


echo '
<label> Nome </label>
  <input type="text" name="name" value="'.$name.'"required >
<label> Rua </label>
  <input type="text" name="address" value="'.$address.'"required>
<label> Cidade </label>
  <input type="text" name="city" value="'.$city.'"required>
<label> Distrito </label>
  <input type="text" name="district" value="'.$district.'"required>
<label> Pais </label>
  <input type="text" name="country" value="'.$country.'"required>
<label> Tipo </label>
  <input type="text" name="type" value="'. $type. '" required>';

?>
<input type="submit" value="Submit">

</form>

</div>

<?php

$name = $_GET['name'];
$address = $_GET['address'];
$city = $_GET['city'];
$district = $_GET['district'];
$country = $_GET['country'];
$type = $_GET['type'];

 include_once('../Database/Connect.php');



$query = $db->prepare("INSERT INTO Restaurants (name, address, type, city, district, country, avgClass, owner)
               VALUES ('$name','$address','$type','$city','$district','$country',0, NULL);");

try{
  $query->execute();
  echo '<div id = Msg >
        <h2> O restaurante foi registado </h2>
        </div>
       ';
}
catch(PDOException $e){


echo '<div id = Msg >
      <h2> O restaurante já se encontra registado </h2>
      </div>
     ';
}

?>


</body>
<?php include_once('../templates/footer.php'); ?>
