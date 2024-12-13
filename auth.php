<?php
session_start();
require_once 'db/db_connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM funcionario WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $user = $result->fetch_assoc();
  if (password_verify($password, $user['senha'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['nome'];
    header("Location: dashboard.php");
    exit;
  } else {
    echo "Senha incorreta!";
  }
} else {
  echo "Email não encontrado!";
}
