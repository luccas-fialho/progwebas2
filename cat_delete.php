<?php
session_start();
require_once 'db/db_connect.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if (isset($_GET['id'])) {
  $id_delete = $_GET['id'];

  $sql_delete = "DELETE FROM gato WHERE id = ?";
  if ($stmt = $conn->prepare($sql_delete)) {
    $stmt->bind_param("i", $id_delete);
    if ($stmt->execute()) {
      header("Location: cats.php?msg=Gato excluído com sucesso!");
    } else {
      header("Location: cats.php?msg=Erro ao excluir o gato.");
    }
    $stmt->close();
  } else {
    header("Location: cats.php?msg=Erro ao preparar a consulta.");
  }
} else {
  header("Location: cats.php?msg=ID do gato não encontrado.");
}
