<head>
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous"></script>
    <script src="../templates/topbar.js"></script>
    <link rel="stylesheet" href="../templates/topbar.css">
</head>

<body>
    <div id="topbar">
        <div id="topbar-elements">
            <h1>
                <a href="../feed/feed.php">Já Comia</a>
            </h1>

            <div id="searchbar">
                <form action="../feed/feed.php" method="get">
                    <input type="text" name="search" placeholder="Search">
                </form>
            </div>

            <div id="topbar-login">
                <button onclick="btnHandler()" class="dropbtn">
                  <?php
                    session_start();
                    session_regenerate_id(true);
                    if (isset($_SESSION["user"])) {
                        echo $_SESSION["user"];
                    } else {
                        echo "Login/Registar";
                    }
                    ?>
                </button>

                <div id="topbar-dropdown" class="dropdown-content">
                  <a href="../userProfile/userProfile.php">My Profile</a>
                  <a href="../newRestaurant/newRestaurant.php">Create Restaurant</a>
                  <a href="../login/logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <div id="login-box" class="box">
        <ul class="box-select">
            <li class="box-option active" onClick="boxHandler(event)">Login</li>
            <li class="box-option" onClick="boxHandler(event)">Registar</li>
        </ul>
        <div id="login">
            <form id="login-form" action="../login/login.php" method="POST">
                <input type="text" name="user" placeholder="Username" required/>
                <input type="password" name="pass" placeholder="Password" required/>
                <input type="submit" value="Login"/>
            </form>
        </div>
        <div id="register">
            <form id="register-form" action="../register/register.php" method="POST">
                <input type="text" name="user" placeholder="Username" required/>
                <input type="password" name="pass" placeholder="Password" required/>
                <input type="password" name="confirm" placeholder="Confirm your password" required/>
                <input type="email" name="email" placeholder="Email" required/>
                <input type="submit" value="Register"/>
            </form>
        </div>
    </div>

</body>
