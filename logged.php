<?php
session_start();
require_once 'db/db_connect.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CatAdopt - Página Inicial</title>
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
      <li class="menu__gatos">
        <a href="cats.php" class="menu__link">Gatinhos Cadastrados</a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <h2>Bem-vindo, <?php echo $_SESSION['user_name']; ?>!</h2>
    <p>Você está logado no sistema. Agora pode acessar os gatinhos cadastrados:</p>
    <a href="cats.php">Clique aqui para visualizar os gatinhos cadastrados</a>
  </div>
</body>

</html>