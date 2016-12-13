<?php include_once '../templates/header.php'; ?>

<body>
  <?php include_once '../templates/topbar.php'; ?>


    <?php if(isset($_SESSION['user'])){

    include_once('../Database/Connect.php');

    $query = $db->prepare('SELECT * ,rowID FROM Users WHERE usr = "'.$_SESSION['user'].'"');

    $query-> execute();

    $result = $query->fetchAll();

    $result = $result[0];

    $name = $result['usr'];
    $email = $result['email'];


    ?>

    <div id="content">
    <img id="pic" src="../resources/default-user-image.png"/>

    <div id="information" >
      <form action="updateUser.php"  method="post" enctype="multipart/form-data">
      <div>
        <label> Nome </label>
          <input type="text" name="name" value="<?php echo $name ?>"required />
      </div>
      <div>
        <label> Email </label>
          <input type="text" name="address" value="<?php echo $email ?>"required />
      </div>
         <input type="submit" name="UpdateUser" value="Update">

      </form>
    </div>
    </div>
    <?php } ?>


</body>


<?php include_once '../templates/footer.php'; ?>
