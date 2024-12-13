<?php
require_once 'db/db_connect.php';

session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sobre</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/about.css" />
  <script src="./scripts/darkMode.js" defer></script>
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
      <li class="active menu__sobre">
        <a href="about.php" class="menu__link">Sobre</a>
      </li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li class="menu__gatos">
          <a href="cats.php" class="menu__link">Gatinhos Cadastrados</a>
        </li>
        <li class="menu__logout">
          <a href="logout.php" class="menu__link">Logout</a>
        </li>
      <?php else: ?>
        <li class="menu__login">
          <a href="login.php" class="menu__link">Login</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>
  <div class="container">
    <section class="container__body">
      <h2 class="titulo">Sobre o trabalho</h2>
      <p class="about">
        Trabalho realizado para a disciplina de Fundamentos de
        Programação Web no segundo semestre de 2024. Site simples que simula uma ong de adoção de gatos,
        com validação de formulário, marcação e estilização de HTML,
        tratamento de dados com JavaScript e persistência de dados em banco de dados MySQL em conjunto com a linguagem PHP.
      </p>
      <p class="autor"><strong>Autor: </strong> Luccas Fialho dos Santos</p>
      <div class="network">
        <a href="https://www.linkedin.com/in/luccas-fialho/" target="_blank">
          <img src="./images/linkedin.png" alt="" class="network__icons">
        </a>
        <a href="https://github.com/luccas-fialho" target="_blank">
          <img src="./images/github-mark.png" alt="" class="network__icons" id="github-icon">
        </a>
      </div>
    </section>
  </div>
</body>

</html>