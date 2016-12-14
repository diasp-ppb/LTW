

<?php

//session_start();
//session_regenerate_id(true);




//if(isset($_SESSION['user'])){

    echo $_POST['name'];

    include_once("../Database/Connect.php");


    $findUser = $db->prepare('SELECT *, rowID FROM Users WHERE usr="'.$_POST['name'].'"');
    $findUser->execute();

    $user = $findUser->fetchAll();


    $count = count($user);
    $user = $user[0];
    if($count >=1 ){

        $id =$user['rowid'];
        
        $deleteOwner = $db->prepare("DELETE FROM Owners WHERE owner ='$id'");
        $deleteOwner-> execute();


        //DELETE ALL COMMENTS he did and replies
        $findReview = $db->prepare("SELECT rowID, * FROM Reviews WHERE userID ='$id'");
        $findReview->execute();


        $result = $findReview->fetchAll();

        //DELETE REVIEW COMMENTS
        foreach($result as $row){
            $delete = $db->prepare("DELETE FROM ReviewComments WHERE review = '$id'");
            $delete->execute();
        }

        //DELETE REVIEWSs

        $delete = $db->prepare("DELETE FROM Reviews WHERE userID ='$id'");
        $delete->execute();

        //DELETE ASSOCIATED IMAGE
        if(isset($user['photo'])){

            $path= '../resources/uploads/'.$user['photo'].'';
            if(file_exists($path))
            {
               unlink ($path);
            }
        }
        //DELETE User

        echo 2;
        $delete = $db->prepare("DELETE FROM Users WHERE rowid='$id'");
        $delete->execute();
    }

    echo 1;
//}



?>
