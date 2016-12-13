<?php include_once '../templates/header.php'; ?>
<?php include_once '../templates/topbar.php'; ?>
<script src="newRestaurant.js"></script>

<body>
    <div id="Intro">
        <img src="../resources/imgNewRestaurant.jpg" />
        <h1>Novo Restaurante<h1>
    </div>
    <div id="FormNewRestaurant">
        <?php if(isset($_SESSION['user'])) { ?>
        <form action="createRestaurant.php" enctype="multipart/form-data" method="POST">
            <label>Nome</label>
            <input type="text" name="name" required>
            <label>Rua</label>
            <input type="text" name="address" required>
            <label>Cidade</label>
            <input type="text" name="city" required>
            <label>Distrito</label>
            <input type="text" name="district" required>
            <label>País</label>
            <input type="text" name="country" required>
            <label>Tipo</label>
            <input type="text" name="type" required>
            <label>Imagem</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" name="submit" value="Create Restaurant">
        </form>
        <?php } else {
            echo '<h1 id="errorMessage"> Precisa de iniciar sessão para criar um restaurante </h1>';
        }
        ?>
    </div>
</body>

<?php include_once '../templates/footer.php'; ?>
