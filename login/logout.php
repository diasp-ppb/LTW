<?php
    session_start();
    session_regenerate_id(true);
    session_unset();
    session_destroy();
    header('Location: ../pages/feed.php');
?>
