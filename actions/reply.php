<?php

    include_once('../Database/Connect.php');


    try {

        echo 'INSERT INTO ReviewComments (review,opinion) VALUES ('.htmlentities($_POST['review']).','.htmlentities($_POST['replyText']).' )';
        $query = $db->prepare('INSERT INTO ReviewComments (review,opinion) VALUES ('.htmlentities($_POST['review']).',"'.htmlentities($_POST['replyText']).'" )');
        $query->execute();
    }
    catch(PDOException $Exception)
    {
        echo $Exception;
    }

    header('Location: ../pages/restaurant.php?id='.htmlentities($_POST['ID']));

?>
