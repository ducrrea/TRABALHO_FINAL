<?php
session_start();
require_once "../conexao_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe o ID enviado pelo formulário do painel
    $pedido_id = intval($_POST['id'] ?? 0);

    if ($pedido_id > 0) {
        try {
            // Comando SQL para deletar o pedido correspondente ao ID
            $sql = "DELETE FROM pedidos WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $pedido_id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                // Redireciona de volta para a listagem avisando que deu certo
                header("Location: pedidos_read.php?sucesso=pedido_excluido");
                exit();
            } else {
                header("Location: pedidos_read.php?erro=1");
                exit();
            }
        } catch (PDOException $e) {
            echo "<h3>Erro ao excluir pedido no PostgreSQL:</h3>" . $e->getMessage();
            echo "<br><a href='pedidos_read.php'>Voltar para o Painel</a>";
            exit();
        }
    } else {
        header("Location: pedidos_read.php?erro=dados_invalidos");
        exit();
    }
} else {
    header("Location: pedidos_read.php");
    exit();
}