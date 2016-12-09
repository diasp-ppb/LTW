<?php
$db = new PDO('sqlite:../Database/dataBase.db');

if (isset($_POST["user"])) {
    $user = str_replace(" ", "", $_POST["user"]);
    $pass = str_replace(" ", "", $_POST["pass"]);
    $email = str_replace(" ", "", $_POST["email"]);

    $mdPass = md5($pass);

    include_once('../Database/Connect.php');

    $stmt = $db->prepare("INSERT INTO Users VALUES ('".$user."','".$mdPass."','".$email."')");
    $result = $stmt->execute();
}

?>
