<?php
session_start();
require_once "../conexao_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe o ID do pedido e o ID do novo status do select
    $pedido_id = intval($_POST['id'] ?? 0);
    $idstatus = intval($_POST['idstatus'] ?? 0);

    if ($pedido_id > 0 && $idstatus > 0) {
        try {
            // Atualiza exatamente a coluna idstatus do seu banco de dados
            $sql = "UPDATE pedidos SET idstatus = :idstatus WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':idstatus', $idstatus, PDO::PARAM_INT);
            $stmt->bindParam(':id', $pedido_id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                // Redireciona de volta para a listagem avisando que atualizou
                header("Location: pedidos_read.php?sucesso=status_atualizado");
                exit();
            } else {
                header("Location: pedidos_read.php?erro=2");
                exit();
            }
        } catch (PDOException $e) {
            echo "<h3>Erro ao atualizar status no PostgreSQL:</h3>" . $e->getMessage();
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