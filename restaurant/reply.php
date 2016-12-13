<?php

    include_once('../Database/Connect.php');


    try {
       
        echo 'INSERT INTO ReviewComments (review,opinion) VALUES ('.$_POST['review'].','.$_POST['replyText'].' )';
        $query = $db->prepare('INSERT INTO ReviewComments (review,opinion) VALUES ('.$_POST['review'].',"'.$_POST['replyText'].'" )');
        $query->execute();
    }
    catch(PDOException $Exception)
    {
        echo $Exception;
    }

    header('Location: ./restaurant.php?id='.$_POST['ID']);

?>