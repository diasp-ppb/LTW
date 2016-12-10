<?php
$db = new PDO('sqlite:../Database/dataBase.db');

if (isset($_POST["user"])) {
    session_start();

    $user = str_replace(" ", "", $_POST["user"]);
    $pass = str_replace(" ", "", $_POST["pass"]);

    $mdPass = md5($pass);

    include_once('../Database/Connect.php');

    $stmt = $db->prepare("SELECT * FROM Users WHERE usr='".$user."' AND pass='".$mdPass."'");
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) == 1) {
        $_SESSION["user"] = $user;
    } else {
        echo "\nLogin falhou.\n";
    }

    header('Location: ../feed/feed.php');
}

?>
