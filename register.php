<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link rel="stylesheet" href="./css/global.css" />
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
      <li class="menu__formulario">
        <a href="login.php" class="menu__link">Login</a>
      </li>
    </ul>
  </nav>
  <div class="container">
    <h2>Cadastro</h2>
    <form action="register_process.php" class="form" method="POST">
      <div class="form__input">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required />
      </div>
      <div class="form__input">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Digite seu email" required />
      </div>
      <div class="form__input">
        <label for="password">Senha</label>
        <input type="password" id="password" name="password" placeholder="Digite sua senha" required />
      </div>
      <div class="form__input">
        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone" placeholder="(99) 99999-9999" required />
      </div>
      <div class="form__actions">
        <button class="form__botao" type="submit">Cadastrar</button>
      </div>
    </form>
    <p>Já possui cadastro? <a href="login.php">Faça login</a></p>
  </div>
</body>

</html>