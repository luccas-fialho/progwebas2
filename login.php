<?php
session_start();
require_once 'db/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $sql = "SELECT * FROM funcionario WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($senha, $user['senha'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['nome'];
      $_SESSION['user_email'] = $user['email'];
      header("Location: logged.php");
      exit();
    } else {
      $error = "Senha incorreta!";
    }
  } else {
    $error = "Usuário não encontrado!";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="./css/form.css" />
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
      <li class="menu__sobre active">
        <a href="login.php" class="menu__link">Login</a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <h2>Login</h2>
    <?php if (isset($error)): ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form class="form" action="login.php" method="POST">
      <div class="form__input">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required placeholder="email@email.com">
      </div>
      <div class="form__input">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required placeholder="Senha">
      </div>
      <div class="form__actions">
        <button class="form__botao" type="submit">Entrar</button>
      </div>
    </form>
    <p><a href="register.php">Não possui cadastro? Cadastre-se</a></p>
  </div>
</body>

</html>