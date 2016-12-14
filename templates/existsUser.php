<?php
$db = new PDO('sqlite:../Database/dataBase.db');

if (isset($_POST["user"])) {
    $user = str_replace(" ", "", htmlentities($_POST["user"]));

    $stmt = $db->prepare("SELECT * FROM Users WHERE usr='".$user."';");
    $stmt->execute();
    $result = $stmt->fetchAll();

    echo json_encode($result);
}
?>
