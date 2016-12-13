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
    $photo = $result['photo'];



    ?>

    <div id="content">
    <?php
        if($photo == NULL)
        echo '<img id="pic" src="../resources/default-user-image.png"/>';
        else
        echo '<img id="pic" src="'. $photo .'"/>';
    ?>
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

      <form action="updateUserPhoto.php" method="post" enctype="multipart/form-data">
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" name="UpdatePhoto" value="Update Profile Photo">
      </form>
    </div>
    </div>
    <?php } ?>


</body>


<?php include_once '../templates/footer.php'; ?>
