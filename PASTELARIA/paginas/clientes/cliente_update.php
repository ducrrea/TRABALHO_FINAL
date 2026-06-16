<?php
session_start();

// 1. Importa a conexão com o banco de dados
require_once "../conexao_bd.php";

// 2. Verifica se a requisição veio correta via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Captura as variáveis vindas dos inputs do modal editar
    $id = intval($_POST['id'] ?? 0);
    $nome = trim($_POST['nome'] ?? '');
    $cep = trim($_POST['cep'] ?? '');
    $numero_residencia = trim($_POST['numero_residencia'] ?? ''); 
    $telefone = trim($_POST['telefone'] ?? '');

    // Validação para garantir que nenhum dado foi enviado em branco
    if (!empty($id) && !empty($nome) && !empty($cep) && !empty($numero_residencia) && !empty($telefone)) {
        try {
            // 3. Monta a SQL usando 'numerocasa' conforme está na tabela do seu banco
            $sql = "UPDATE clientes 
                    SET nome = :nome, cep = :cep, numerocasa = :numero_residencia, telefone = :telefone 
                    WHERE id = :id";
            
            $stmt = $conexao->prepare($sql);

            // Associa os parâmetros de forma segura
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':numero_residencia', $numero_residencia);
            $stmt->bindParam(':telefone', $telefone);

            // 4. Executa e redireciona de volta para a lista atualizada
            if ($stmt->execute()) {
                header("Location: cliente_read.php?sucesso=atualizado");
                exit();
            } else {
                echo "Erro ao executar a atualização.";
                exit();
            }

        } catch (PDOException $e) {
            echo "<h3>Erro ao atualizar no banco de dados:</h3>" . $e->getMessage();
            exit();
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
        exit();
    }
} else {
    header("Location: cliente_read.php");
    exit();
}
?>