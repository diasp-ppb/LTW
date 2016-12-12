<?php
$db = new PDO('sqlite:../Database/dataBase.db');

if (isset($_POST["user"])) {
    $user = str_replace(" ", "", $_POST["user"]);

    $stmt = $db->prepare("SELECT * FROM Users WHERE usr='".$user."';");
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) == 1) {
        echo 1;
    } else {
        echo 0;
    }
}
