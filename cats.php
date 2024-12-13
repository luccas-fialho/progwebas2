<?php
session_start();
require_once 'db/db_connect.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$sql = "SELECT * FROM gato";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gatinhos Cadastrados</title>
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/form.css" />
  <link rel="stylesheet" href="css/cats.css" />
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
      <?php if (isset($_SESSION['user_id'])): ?>

        <li class="menu__logout">
          <a href="logout.php" class="menu__link">Logout</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>

  <div class="container">
    <h2>Gatinhos Cadastrados</h2>
    <a href="cat_create.php" class="form__botao">Adicionar Novo Gato</a>
    <?php if ($result->num_rows > 0): ?>
      <table class="table">
        <tr>
          <th>Foto</th>
          <th>Nome</th>
          <th>Raça</th>
          <th>Idade</th>
          <th>Sexo</th>
          <th>Descrição</th>
          <th>Ação</th>
        </tr>
        <?php while ($gato = $result->fetch_assoc()): ?>
          <tr>
            <td>
              <?php if ($gato['foto']): ?>
                <img class="cat__photo" src="data:image/jpeg;base64,<?= base64_encode($gato['foto']) ?>" alt="Foto do gato" width="100" height="100">
              <?php else: ?>
                <img class="cat__photo" src="images/default_cat.webp" alt="Foto padrão" width="100" height="100">
              <?php endif; ?>
            </td>
            <td><?php echo $gato['nome']; ?></td>
            <td><?php echo $gato['raca']; ?></td>
            <td><?php echo $gato['idade']; ?></td>
            <td><?php echo $gato['sexo']; ?></td>
            <td><?php echo $gato['descricao']; ?></td>
            <td>
              <a href="cat_edit.php?id=<?php echo $gato['id']; ?>"><img src="./images/edit.png" alt="" width="25px" height="25px"></a> |
              <a href="cat_delete.php?id=<?php echo $gato['id']; ?>"
                onclick="return confirm('Tem certeza que deseja excluir este gato?');"><img src="./images/delete.png" alt="" width="25px" height="25px"></a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p>Nenhum gatinho cadastrado.</p>
    <?php endif; ?>
  </div>
</body>

</html>