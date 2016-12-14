<?php
if (isset($_POST["user"])) {
    session_start();
    session_regenerate_id(true);
    $_SESSION["user"] = htmlentities($_POST["user"]);
    header('Location: ../feed/feed.php');
}
?>
