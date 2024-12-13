<?php
session_start();
require_once 'db/db_connect.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if (!isset($_GET['id'])) {
  die("ID do gato não fornecido.");
}

$id_gato = $_GET['id'];

$sql = "SELECT * FROM gato WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_gato);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
  die("Gato não encontrado.");
}

$gato = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $raca = $_POST['raca'];
  $idade = $_POST['idade'];
  $sexo = $_POST['sexo'];
  $descricao = $_POST['descricao'];
  $foto = null;

  if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto_tmp = $_FILES['foto']['tmp_name'];

    $image_info = getimagesize($foto_tmp);
    if ($image_info === false) {
      die("O arquivo enviado não é uma imagem válida.");
    }

    $foto_conteudo = file_get_contents($foto_tmp);
    $foto = $foto_conteudo;
  }

  if ($foto) {
    $sql_update = "UPDATE gato SET nome = ?, raca = ?, idade = ?, sexo = ?, descricao = ?, foto = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('ssisssi', $nome, $raca, $idade, $sexo, $descricao, $foto, $id_gato);
  } else {
    $sql_update = "UPDATE gato SET nome = ?, raca = ?, idade = ?, sexo = ?, descricao = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param('ssissi', $nome, $raca, $idade, $sexo, $descricao, $id_gato);
  }

  if ($stmt_update->execute()) {
    header("Location: cats.php");
    exit();
  } else {
    $error = "Erro ao atualizar os dados do gato.";
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Gato</title>
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
      <li class="menu__home"><a href="index.php" class="menu__link">Home</a></li>
      <li class="menu__formulario"><a href="form.php" class="menu__link">Formulário</a></li>
      <li class="menu__sobre"><a href="about.php" class="menu__link">Sobre</a></li>
      <li class="menu__gatos"><a href="cats.php" class="menu__link">Gatinhos Cadastrados</a></li>
    </ul>
  </nav>

  <div class="container">
    <h2>Editar Gato - <?php echo $gato['nome']; ?></h2>

    <?php if (isset($error)): ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <form class="form" action="cat_edit.php?id=<?php echo $gato['id']; ?>" method="POST" enctype="multipart/form-data">
      <div class="form__input">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php echo $gato['nome']; ?>" required>
      </div>

      <div class="form__input">
        <label for="raca">Raça</label>
        <input type="text" name="raca" id="raca" value="<?php echo $gato['raca']; ?>" required>
      </div>
      <div class="form__input">
        <label for="idade">Idade</label>
        <input type="number" name="idade" id="idade" value="<?php echo $gato['idade']; ?>" required>
      </div>
      <div class="form__input">
        <label for="sexo">Sexo</label>
        <input type="text" name="sexo" id="sexo" value="<?php echo $gato['sexo']; ?>" required>
      </div>
      <div class="form__input">
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao"><?php echo $gato['descricao']; ?></textarea>
      </div>
      <div class="form__input">
        <label for="foto">Foto (opcional)</label>
        <input type="file" name="foto" id="foto" accept="image/*">

        <?php if ($gato['foto']): ?>
          <div>
            <h3>Foto Atual:</h3>
            <?php
            $base64foto = base64_encode($gato['foto']);
            echo "<img src='data:image/jpeg;base64,$base64foto' alt='Foto do Gato' style='max-width: 200px;'>";
            ?>
          </div>
        <?php else: ?>
          <p>Este gato ainda não possui foto.</p>
        <?php endif; ?>
      </div>
      <div class="form__actions">
        <button class="form__botao" type="submit">Atualizar</button>
      </div>
    </form>
  </div>
</body>

</html>