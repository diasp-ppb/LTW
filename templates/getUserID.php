<?php

function getUserID(){
    include '../Database/Connect.php';
    session_start();
    $username = $_SESSION["user"];
    $getuserid = $db->prepare("SELECT rowid FROM Users WHERE usr = '$username';");
    $getuserid->execute();
    $use = $getuserid->fetchAll();
    $userid = $use[0];
    $usernum = $userid['rowid'];

    return $usernum;

}

?>
