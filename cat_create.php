<?php
session_start();
require_once 'db/db_connect.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $funcionario = $_SESSION['user_id'];
  $nome = $_POST['nome'];
  $raca = $_POST['raca'];
  $idade = $_POST['idade'];
  $sexo = $_POST['sexo'];
  $descricao = $_POST['descricao'];

  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto = file_get_contents($_FILES['foto']['tmp_name']);
  } else {
    $foto = null;
  }

  $sql = "INSERT INTO gato (nome, raca, idade, sexo, descricao, foto, funcionario_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssisssi", $nome, $raca, $idade, $sexo, $descricao, $foto, $funcionario);

  if ($stmt->execute()) {
    header("Location: cats.php");
    exit();
  } else {
    $error_message = "Erro ao cadastrar o gato. Tente novamente.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastrar Novo Gato</title>
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/form.css" />
  <script src="scripts/darkMode.js" defer></script>
</head>

<body>
  <nav class="menu">
    <h1 class="menu__logo">CatAdopt</h1>
    <ul class="menu__lista">
      <li class="menu__darkModeToggle">
        <button id="darkModeToggle">🌙 Modo Escuro</button>
      </li>
      <li class="menu__home">
        <a href="index.php" class="menu__link">Home</a>
      </li>
      <li class="menu__formulario">
        <a href="form.php" class="menu__link">Formulário</a>
      </li>
      <li class="menu__sobre">
        <a href="about.php" class="menu__link">Sobre</a>
      </li>
      <li class="menu__gatos active">
        <a href="cats.php" class="menu__link">Gatinhos Cadastrados</a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <h2>Cadastrar Novo Gato</h2>

    <?php if (isset($error_message)): ?>
      <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form class="form" action="cat_create.php" method="POST" enctype="multipart/form-data">
      <div class="form__input">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="form__input">
        <label for="raca">Raça:</label>
        <select id="raca" name="raca" required>
          <option value="" selected>Selecione uma raça</option>
          <option value="Siamês">Siamês</option>
          <option value="Persa">Persa</option>
          <option value="Maine Coon">Maine Coon</option>
          <option value="Abissínio">Abissínio</option>
          <option value="Bengal">Bengal</option>
          <option value="Ragdoll">Ragdoll</option>
          <option value="British Shorthair">British Shorthair</option>
          <option value="Sphynx">Sphynx</option>
          <option value="Exotic Shorthair">Exotic Shorthair</option>
        </select>
      </div>
      <div class="form__input">
        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade" required>
      </div>
      <div class="form__input">
        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo" required>
      </div>
      <div class="form__input">
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
      </div>
      <div class="form__input">
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*">
      </div>
      <div class="form__actions">
        <button class="form__botao" type="submit">Cadastrar Gato</button>
      </div>
    </form>

    <br>
    <a href="cats.php">Voltar para a lista de gatos cadastrados</a>
  </div>
</body>

</html>