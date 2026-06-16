<?php
session_start();
require_once "conexao_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if (!empty($id)) {
        try {
            // Executa a remoção do sabor selecionado
            $sql = "DELETE FROM produtos WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: produtos_read.php?sucesso=produto_deletado");
                exit();
            } else {
                header("Location: produtos_read.php?erro=erro_banco");
                exit();
            }
        } catch (PDOException $e) {
            // Caso ocorra restrição de chave (ex: o produto já esteja associado a algum histórico de vendas)
            echo "Não é possível remover este sabor pois ele faz parte de pedidos existentes: " . $e->getMessage();
            exit();
        }
    } else {
        header("Location: produtos_read.php?erro=id_invalido");
        exit();
    }
} else {
    header("Location: produtos_read.php");
    exit();
}
?>