<?php
session_start();

// 1. Importa a conexão com o banco de dados
require_once "../conexao_bd.php";

// 2. Verifica se o ID foi enviado via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    
    $id = intval($_POST['id']);

    if (!empty($id)) {
        try {
            // 3. Executa o comando para deletar da tabela clientes
            $sql = "DELETE FROM clientes WHERE id = :id"; 
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // SUCESSO: Volta para a listagem (o modal some e o bloco do cliente desaparece)
                header("Location: cliente_read.php?sucesso=deletado");
                exit();
            } else {
                header("Location: cliente_read.php?erro=erro_banco");
                exit();
            }

        } catch (PDOException $e) {
            // Caso aconteça algum erro de restrição de chave (ex: cliente tem pedidos associados)
            header("Location: cliente_read.php?erro=" . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header("Location: cliente_read.php?erro=id_invalido");
        exit();
    }
} else {
    // Se tentarem acessar o arquivo direto, joga de volta para a listagem
    header("Location: cliente_read.php");
    exit();
}
?>