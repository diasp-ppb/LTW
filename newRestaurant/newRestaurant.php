<?php include_once '../templates/header.php'; ?>
<?php include_once '../templates/topbar.php'; ?>

<head>
    <title> Já Comia - Create New Restaurant </title>
    <script src="newRestaurant.js"></script>
</head>
<body>
    <div id="Intro">
        <img src="../resources/imgNewRestaurant.jpg" />
        <h1>Novo Restaurante<h1>
    </div>
    <div id="FormNewRestaurant">
        <?php if(isset($_SESSION['user'])) { ?>
        <form action="createRestaurant.php" enctype="multipart/form-data" method="POST">
            <label>Nome</label>
            <input type="text" name="name" pattern="[a-zA-Z0-9\s]+" title="Insert letters, numbers and spaces only." required>
            <label>Rua</label>
            <input type="text" name="address" pattern="[a-zA-Z0-9\s]+" title="Insert letters, numbers and spaces only." required>
            <label>Cidade</label>
            <input type="text" name="city" pattern="[a-zA-Z\s]+" title="Insert letters and spaces only." required>
            <label>Distrito</label>
            <input type="text" name="district" pattern="[a-zA-Z\s]+" title="Insert letters and spaces only." required>
            <label>País</label>
            <input type="text" name="country" pattern="[a-zA-Z\s]+" title="Insert letters and spaces only." required>
            <label>Tipo</label>
            <input type="text" name="type" pattern="[a-zA-Z0-9\s]+" title="Insert letters, numbers and spaces only." required>
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
