<?php

    include_once('../Database/Connect.php');
    
    session_start();
   
    if(isset($_SESSION['user'])){

   
    $name = $_SESSION['user'];
    $query = $db->prepare('SELECT * ,rowID FROM Users WHERE usr = "'.$name.'"');

    $query->execute();

    $result = $query->fetchAll();



     if(count($result) > 0)
     {
         try{

             $newName = $_POST['name'];
             $email= $_POST['email'];
             

             $update = $db->prepare('UPDATE Users SET  usr="'.$newName.'" ,email = "'.$email.'" WHERE usr="'.$name.'"');

             $update->execute();

             $_SESSION['user'] =$newName;
         }  catch(PDOException $Exception)
          {
             echo $Exception;
          }
       

     }


     header("Location: ../userProfile/userProfile.php");
    }
?>