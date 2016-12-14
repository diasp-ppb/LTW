<!DOCTYPE html>
<html>

<head>
    <title>Já Comia - Admin Page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../templates/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>

<body>




<?php


    include_once("../Database/Connect.php");
    session_start();
    $user = $_SESSION['user'];

    if($user == "admin"){

    //COUNT USERS
    $query = $db->prepare('SELECT COUNT(*) FROM Users');
    $query->execute();
    $nUsers =  $query->fetchColumn();

    //COUNT RESTAURANTS

    $query = $db->prepare('SELECT COUNT(*) FROM Restaurants');
    $query->execute();
    $Restaurants =  $query->fetchColumn();


   //COUNT Reviews

    $query = $db->prepare('SELECT COUNT(*) FROM Reviews');
    $query->execute();
    $Reviews =  $query->fetchColumn();



   $ReviewsDivRest = round($Reviews/$Restaurants,2);


    $query = $db->prepare('SELECT COUNT(*) FROM ReviewComments');
    $query->execute();
    $Replies  =  $query->fetchColumn();


   $RepliesDivReviews = round($Replies/$Reviews,2);

   $UserDivRes = round($nUsers/$Restaurants,2);

   $OpinDivUser = round($Reviews/$nUsers,2);


   //AVG Classification all restaurant

    $query = $db->prepare('SELECT AVG(avgClass) FROM Restaurants');
    $query->execute();
    $AVGclassifRest  =  $query->fetchColumn();


    // COUNT N images Restaurants in DB
    $query = $db->prepare('SELECT COUNT(*) FROM Images');
    $query->execute();
    $Images =   $query->fetchColumn();




    //COUNT N images users in DB


    // COUNT N images Restaurants in DB
    $query = $db->prepare('SELECT COUNT(*) FROM Users WHERE photo != "" ');
    $query->execute();
    $ImagesUsers =   $query->fetchColumn();








   //Images Uploads directory size
    $dir = "../resources/uploads";
    $bytes = 0;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $i)
    {
        $bytes += $i->getSize();
    }


    $bytes=round($bytes/1024);








?>



<div id="statistics">
<table id="stat_table">
    <tr>
        <th><h3>Nº Utilizadores         </h3></th>
        <th><h3>Nº Restaurantes         </h3></th>
        <th><h3>Nº Opinioes             </h3></th>
        <th><h3>Nº Respostas a Opinioes </h3></th>
        <th><h3>Opinioes/Restaurante    </h3></th>
        <th><h3>Respostas/Opinioes      </h3></th>
    </tr>
    <tr>
        <td><?php echo $nUsers         ?> </td>
        <td><?php echo $Restaurants    ?> </td>
        <td><?php echo $Reviews        ?> </td>
        <td><?php echo $Replies        ?> </td>
        <td><?php echo $ReviewsDivRest ?> </td>
        <td><?php echo $RepliesDivReviews ?> </td>
    </tr>

    <tr>
        <th><h3>Nº Utilizadores/Restaurantes         </h3></td>
        <th><h3>Nº Opinioes/Utilizadores             </h3></td>
        <th><h3>Classificação Med. Restaurantes      </h3></td>
        <th><h3>Nº Imagens  de Restaurantes          </h3></td>
        <th><h3>Nº Imagens  de Utilizadores          </h3></td>
        <th><h3>Tamanho Dir Uploads                  </h3></td>

    </tr>

    <tr>
        <td><?php echo $UserDivRes                      ?> </td>
        <td><?php echo $OpinDivUser                     ?> </td>
        <td><?php echo $AVGclassifRest                  ?> </td>
        <td><?php echo $Images                          ?> </td>
        <td><?php echo $ImagesUsers                     ?> </td>
        <td><?php echo $bytes?> kB                         </td>
    </tr>

 </table>

</div>

<div id="editDatabase">




<form action="deleteUser.php" method="post">
    <label> Apagar Utilizador </label>
    <input  type="text" name="name" placeholder="nome"/>
    <input   type="submit" name ="UserC" value="Apagar" />
</form>


<form action="deleteRestaurant.php" method="post">
    <label> Apagar Restaurante </label>
    <input  type="text" name="name" placeholder="nome"/>
    <input  type="text" name="street" placeholder="rua"/>
    <input  type="text" name="district" placeholder="cidade"/>
    <input  type="text" name="country" placeholder="pais"/>
    <input  type="submit" name ="RestaurantC" value="Apagar" />
</form>


<form >
    <label> Apagar Opiniao </label>
    <input  type="text" name="title" placeholder="titulo"/>
    <input  type="text" name="content" placeholder="conteudo"/>
    <input  type="text" name="user" placeholder="utilizador"/>
    <input  type="text" name="restaurant" placeholder="restaurante"/>
    <input  type="submit" name ="ReviewC" value="Apagar" />
</form>

<form>
    <a href="../feed/feed.php"> Feed </a>
</form>

<form>
     <input  type="submit" name ="logout" value="Sair" />
</form>

</div>

</body>

<?php }
    else {
        echo '<h1>Need admin to access this page!</h1>';
    }
include_once('../templates/footer.php') ?>
