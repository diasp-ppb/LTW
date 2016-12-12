<?php include_once '../templates/header.php'; ?>

<body>
  <?php include_once '../templates/topbar.php'; ?>

    <div id="Intro">

        <img src="../resources/imgNewRestaurant.jpg" />
        <h1> Novo Restaurante <h1>
    </div>




    <div id="FormNewRestaurant">

    <?php if(isset($_SESSION['user'])) 
    {
    ?>
      <form action="newRestaurant.php"  method="post">

        <?php

        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $country = $_POST['country'];
        $type = $_POST['type'];

        echo '
        <label> Nome </label>
          <input type="text" name="name" value="'.$name.'"required >
        <label> Rua </label>
          <input type="text" name="address" value="'.$address.'"required>
        <label> Cidade </label>
          <input type="text" name="city" value="'.$city.'"required>
        <label> Distrito </label>
          <input type="text" name="district" value="'.$district.'"required>
        <label> País </label>
          <input type="text" name="country" value="'.$country.'"required>
        <label> Tipo </label>
          <input type="text" name="type" value="'.$type.'" required>';

        ?>
        <input type="submit" name="Regist" value="Submit">

      </form>


      <form action="../templates/uploadImage.php" method="post" enctype="multipart/form-data">
          <label>Select image to upload:</label>
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit">
      </form>

      <?php 
        } else {
        echo '<h1> Precisa de iniciar sessão para criar um restaurante </h1>';
      }
      ?>
    </div>

<?php
 if( isset($_POST['Regist'] )){
        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $country = $_POST['country'];
        $type = $_POST['type'];

        include_once '../Database/Connect.php';

        $query = $db->prepare("INSERT INTO Restaurants (name, address, type, city, district, country, avgClass)
                   VALUES ('$name','$address','$type','$city','$district','$country',NULL);");

        try {
            $query->execute();
            echo '<div id = Msg >
                      <h2> O restaurante foi registado </h2>
                      </div>
                      ';
        } catch (PDOException $e) {
            echo '<div id = Msg >
                      <h2> O restaurante já se encontra registado </h2>
                      </div>
                      ';
        }
}
?>


</body>



<?php include_once '../templates/footer.php'; ?>
