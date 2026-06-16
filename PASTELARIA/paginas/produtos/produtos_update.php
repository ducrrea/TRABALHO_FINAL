<?php
session_start();
require_once "conexao_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $preco = floatval($_POST['preco'] ?? 0);

    if (!empty($id) && !empty($nome) && $preco > 0) {
        try {
            // Executa a atualização na tabela de produtos
            $sql = "UPDATE produtos SET nome = :nome, preco = :preco WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':preco', $preco);

            if ($stmt->execute()) {
                header("Location: produtos_read.php?sucesso=produto_atualizado");
                exit();
            } else {
                echo "Erro ao atualizar o sabor.";
                exit();
            }
        } catch (PDOException $e) {
            echo "Erro na base de dados: " . $e->getMessage();
            exit();
        }
    } else {
        echo "Por favor, preencha todos os campos do produto corretamente.";
        exit();
    }
} else {
    header("Location: produtos_read.php");
    exit();
}
?>