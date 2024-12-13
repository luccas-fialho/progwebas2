<?php
require_once 'db/db_connect.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$password = $_POST['password'];
$telefone = $_POST['telefone'];

// Criptografando a senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "INSERT INTO funcionario (nome, email, senha, telefone) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssss', $nome, $email, $hashed_password, $telefone);

if ($stmt->execute()) {
  echo "Cadastro realizado com sucesso!";
  header("Location: login.php");
} else {
  echo "Erro ao cadastrar!";
}
