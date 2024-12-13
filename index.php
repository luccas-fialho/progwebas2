<?php
# TRABALHO DESENVOLVIDO PARA A DISCIPLINA DE FUNDAMENTOS DE PROGRAMAÇÃO WEB PUC PR
# AUTOR: LUCCAS FIALHO DOS SANTOS
# DATA: 02/12/2024
# LINK PARA O VIDEO NO YT: https://www.youtube.com/watch?v=HE9TmQ3qjhQ

session_start();

require_once 'db/db_connect.php';

$sql = "SELECT id, nome, raca, idade, descricao, foto FROM gato";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Atividade Somativa 1</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/home.css" />
  <script src="./scripts/darkMode.js" defer></script>
</head>

<body>
  <nav class="menu">
    <h1 class="menu__logo">CatAdopt</h1>
    <ul class="menu__lista">
      <li class="menu__darkModeToggle">
        <button id="darkModeToggle">🌙 Modo Escuro</button>
      </li>
      <li class="active menu__home">
        <a href="index.php" class="menu__link">Home</a>
      </li>
      <li class="menu__formulario">
        <a href="form.php" class="menu__link">Formulário</a>
      </li>
      <li class="menu__sobre">
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
  <section class="container">
    <section class="container__body">
      <h2 class="titulo">Adote um amiguinho!</h2>
      <p>
        Não deixe que um de nossos amiguinhos fique sozinho! Adote um gatinho e seja feliz!
      </p>
      <section class="container__cats">
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $foto = !empty($row['foto']) ? 'data:image/jpeg;base64,' . base64_encode($row['foto']) : './images/default_cat.webp';
            echo '<div class="cat__card">';
            echo '<img src="' . $foto . '" alt="Foto de ' . htmlspecialchars($row['nome']) . '" class="cat__img" />';
            echo '<div class="cat__info">';
            echo '<p class="cat__name">' . htmlspecialchars($row['nome']) . '</p>';
            echo '<p class="cat__desc">' . htmlspecialchars($row['descricao']) . '</p>';
            echo '</div>';
            echo '</div>';
          }
        } else {
          echo '<p>Nenhum gato disponível para adoção no momento.</p>';
        }
        ?>
      </section>
    </section>
  </section>
</body>

</html>

<?php
$conn->close();
?>