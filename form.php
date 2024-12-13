<?php
require_once 'db/db_connect.php';

session_start();

$sql = "SELECT * FROM gato";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $gatos = $result->fetch_all(MYSQLI_ASSOC);
} else {
  $gatos = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulário</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/form.css" />
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
      <li class="active menu__formulario">
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

  <div class="container">
    <h2>Formulário</h2>
    <form action="formAction.php" class="form" method="GET">
      <div class="form__input">
        <label for="name">Seu nome</label>
        <input type="text" id="name" name="name" placeholder="nome" required />
      </div>
      <div class="form__input">
        <label for="sobrenome">Seu sobrenome</label>
        <input type="text" id="sobrenome" name="sobrenome" placeholder="sobrenome" required />
      </div>
      <div class="form__input">
        <label for="email">Email</label>
        <input type="email" id="email" class="email" name="email" placeholder="email@email.com" required />
      </div>
      <div class="form__input">
        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" class="telefone" name="telefone" pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}" placeholder="(99) 99999-9999" required />
      </div>

      <div class="form__input">
        <label for="cat_id">Nome do gato(a) a ser adotado(a)</label>
        <select name="cat_id" id="cat_id" required>
          <option value="" selected>Selecione um Gato(a)</option>
          <?php if (!empty($gatos)): ?>
            <?php foreach ($gatos as $gato): ?>
              <option value="<?php echo $gato['id']; ?>"><?php echo $gato['nome']; ?></option>
            <?php endforeach; ?>
          <?php else: ?>
            <option value="">Nenhum gato cadastrado</option>
          <?php endif; ?>
        </select>
      </div>
      <div class="form__actions">
        <button class="form__botao" type="submit">Enviar</button>
      </div>
    </form>
  </div>
</body>

</html>