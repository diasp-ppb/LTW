<?php
include_once('../Database/Connect.php');

if (isset($_POST["user"])) {
    $user = str_replace(" ", "", htmlentities($_POST["user"]));
    $pass = str_replace(" ", "", htmlentities($_POST["pass"]));

    $mdPass = md5($pass);

    $stmt = $db->prepare("SELECT * FROM Users WHERE usr='".$user."' AND pass='".$mdPass."';");
    $stmt->execute();
    $result = $stmt->fetchAll();

    echo json_encode($result);
}
?>
