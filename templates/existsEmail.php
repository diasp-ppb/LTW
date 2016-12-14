<?php
$db = new PDO('sqlite:../Database/dataBase.db');

if (isset($_POST["email"])) {
    $email = str_replace(" ", "", htmlentities($_POST["email"]));

    $stmt = $db->prepare("SELECT * FROM Users WHERE email='".$email."';");
    $stmt->execute();
    $result = $stmt->fetchAll();

    echo json_encode($result);
}
?>
