<?php
$db = new PDO('sqlite:../Database/dataBase.db');

if (isset($_POST["user"])) {
    $user = str_replace(" ", "", $_POST["user"]);
    $pass = str_replace(" ", "", $_POST["pass"]);

    echo $user;
    echo $pass;

    include_once('../Database/Connect.php');

    $stmt = $db->prepare("SELECT * FROM Users WHERE usr='".$user."' AND pass='".$pass."'");
    $stmt->execute();
    $result = $stmt->fetchAll();

    if (count($result) != 1) {
        echo "\nLogin nao feito.\n";
    } else {
        echo "\nLogin feito.\n";
    }
}

?>
