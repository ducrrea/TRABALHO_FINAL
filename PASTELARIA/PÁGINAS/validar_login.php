<?php
session_start();

require_once 'conexao_bd.php';

$nome = $_POST['nome'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios
        WHERE nome = :nome
        AND senha = :senha";

$stmt = $conexao->prepare($sql);

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':senha', $senha);

$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {

    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];

    header("Location: index.php");
    exit();

} else {

    header("Location: login.php?erro=1");
    exit();

}
?>