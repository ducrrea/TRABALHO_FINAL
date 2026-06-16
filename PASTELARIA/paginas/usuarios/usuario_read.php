<?php
session_start();

// Ativa exibição de erros para pegarmos qualquer falha do PostgreSQL
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../conexao_bd.php";

try {
    // Busca todos os operadores cadastrados na sua tabela do PostgreSQL
    $sql = "SELECT id, nome FROM usuarios ORDER BY id ASC";
    $resultado = $conexao->query($sql);
    $usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<h3>Erro ao conectar ou buscar usuários:</h3>" . $e->getMessage();
    $usuarios = [];
}
?>
<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestão de Usuários - L'Art du Pastel</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
                "primary": "#775a19",
                "surface-container-low": "#f5f4ec",
                "outline-variant": "#d1c5b4",
                "on-surface": "#1b1c17"
            }
          }
        }
      }
    </script>
</head>
<body class="bg-[#fbf9f1] p-6 font-[Montserrat] text-on-surface">

<main class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-2xl border border-outline-variant/40 shadow-sm">
    <div class="flex justify-between items-center mb-8 pb-4 border-b border-outline-variant/30">
        <div>
            <h1 class="text-3xl font-['Playfair_Display'] font-bold text-primary">Funcionários Cadastrados</h1>
            <p class="text-xs text-gray-400 mt-1">Painel de controle de acesso</p>
        </div>
        
        <a href="usuario_create.php" class="px-5 py-2.5 bg-primary text-white text-xs font-bold uppercase tracking-wider rounded-xl hover:opacity-90 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">add</span> Novo Usuário
        </a>
    </div>

    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'cadastrado'): ?>
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg text-xs font-semibold">Usuário cadastrado com sucesso!</div>
    <?php endif; ?>
    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'deletado'): ?>
        <div class="mb-4 p-3 bg-amber-100 text-amber-800 rounded-lg text-xs font-semibold">Usuário removido com sucesso!</div>
    <?php endif; ?>

    <div class="overflow-hidden border border-outline-variant/30 rounded-xl">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-xs font-bold uppercase tracking-wider text-gray-600 border-b border-outline-variant/30">
                    <th class="p-4 w-20">ID</th>
                    <th class="p-4">Nome do Operador</th>
                    <th class="p-4 text-center w-40">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20 text-sm">
                <?php if (count($usuarios) === 0): ?>
                    <tr>
                        <td colspan="3" class="p-8 text-center text-gray-400">Nenhum funcionário encontrado no banco de dados.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($usuarios as $user): ?>
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="p-4 font-bold text-primary">#<?= $user['id'] ?></td>
                            <td class="p-4 font-medium"><?= htmlspecialchars($user['nome']) ?></td>
                            <td class="p-4 flex justify-center gap-4">
                                <a href="usuario_update.php?id=<?= $user['id'] ?>" class="text-primary hover:underline flex items-center gap-1 text-xs font-semibold" title="Editar">
                                    <span class="material-symbols-outlined text-sm">edit</span> Editar
                                </a>
                                <a href="usuario_delete.php?id=<?= $user['id'] ?>" class="text-red-600 hover:underline flex items-center gap-1 text-xs font-semibold" title="Excluir">
                                    <span class="material-symbols-outlined text-sm">delete</span> Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex justify-between items-center border-t border-outline-variant/20 pt-4">
        <a href="../home.php" class="text-xs text-primary font-bold uppercase tracking-wider flex items-center gap-1 hover:underline">
            <span class="material-symbols-outlined text-sm">arrow_back</span> Voltar para a Vitrine
        </a>
    </div>
</main>

</body>
</html>