<head>
    <script src="../templates/topbar.js"></script>
    <link rel="stylesheet" href="../templates/topbar.css">
</head>

<div id="topbar">
  <div id="topbar-elements">

    <h1><a href="../feed/feed.php">Já Comia</a></h1>

    <div id="searchbar">
        <form action="../feed/feed.php" method="get">
            <input type="text" name="search" placeholder="Search">
        </form>
    </div>

    <div id="topbar-login">

      <button onclick="myFunction()" class="dropbtn">
          <?php
            session_start();
            echo $_SESSION["user"];
            ?>
      </button>
      <div id="topbar-dropdown" class="dropdown-content">
          <a href="#">My Profile</a>
          <a href="../newRestaurant/newRestaurant.php">Create Restaurant</a>
          <a href="#">Log Out</a>
      </div>
    </div>



  </div>
</div>
