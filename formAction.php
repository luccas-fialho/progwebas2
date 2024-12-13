<?php
require_once 'db/db_connect.php';

if (isset($_GET['cat_id'])) {
  $cat_id = intval($_GET['cat_id']);

  $stmt = $conn->prepare("SELECT * FROM gato WHERE id = ?");
  $stmt->bind_param("i", $cat_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $gato = $result->fetch_assoc();
  } else {
    echo "Gato não encontrado.";
    exit;
  }
} else {
  echo "Nenhum gato selecionado.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>Dados do Formulário</title>
  <link rel="stylesheet" href="./css/global.css" />
  <link rel="stylesheet" href="./css/formAction.css" />
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
    </ul>
  </nav>
  <section class="container">
    <section class="container__body">
      <p class="congrats">PARABÉNS POR TER ADOTADO UM NOVO AMIGUINHO!</p>
      <img class="congrats__img" src="./images/congratulations.webp" alt="">
      <h2 class="titulo">Informações do Formulário</h2>
      <div id="container__form_infos">
        <?php
        $nome = htmlspecialchars($_GET['name']);
        $sobrenome = htmlspecialchars($_GET['sobrenome']);
        $email = htmlspecialchars($_GET['email']);
        $telefone = htmlspecialchars($_GET['telefone']);

        if (isset($gato)) {
          echo "
        <section class='adoption__infos'>
            <div class='personal__info'>
                <span><strong>Informações Pessoais:</strong></span>
                <p class='name'>Nome: $nome $sobrenome</p>
                <p>Email: $email</p>
                <p>Telefone: $telefone</p>
                <span><strong>Gatinho(a) adotado(a): </strong></span>
                <p>Nome: " . htmlspecialchars($gato['nome']) . "</p>
                <p>Raça: " . htmlspecialchars($gato['raca']) . "</p>
                <p>Idade: " . htmlspecialchars($gato['idade']) . "</p>
                <p>Sexo: " . htmlspecialchars($gato['sexo']) . "</p>
            </div>
            <div class='adopted__info'>
                <img class='cat__image' src='data:image/jpeg;base64," . base64_encode($gato['foto']) . "' alt='Foto do gatinho(a) a ser adotado(a)'>
            </div>
        </section>";
        } else {
          echo "<p>Erro: As informações do gatinho(a) não foram encontradas.</p>";
        }
        ?>
      </div>

    </section>
  </section>
</body>

</html>