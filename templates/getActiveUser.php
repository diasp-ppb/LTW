<?php
    session_start();
    session_regenerate_id(true);
    echo $_SESSION["user"];
?>
