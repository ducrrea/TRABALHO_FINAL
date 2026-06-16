<?php
session_start();
require_once "../conexao_bd.php";

$mensagem_sucesso = "";
$mensagem_erro = "";

// Captura as mensagens de retorno vindo dos seus arquivos externos via GET
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 'pedido_realizado') $mensagem_sucesso = "Pedido enviado para a cozinha com sucesso!";
    if ($_GET['sucesso'] == 'status_atualizado') $mensagem_sucesso = "Status do pedido atualizado com sucesso!";
    if ($_GET['sucesso'] == 'pedido_excluido') $mensagem_sucesso = "Pedido removido do sistema!";
}
if (isset($_GET['erro'])) {
    $mensagem_erro = "Ocorreu um erro ao processar a requisição nos arquivos de controle.";
}

// ==========================================
// 1. BUSCA DE STATUS DISPONÍVEIS (Para o Select)
// ==========================================
try {
    $sql_status = "SELECT id, descricao FROM status_pedidos ORDER BY id ASC";
    $stmt_status = $conexao->query($sql_status);
    $lista_status = $stmt_status->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $lista_status = [];
}

// ==========================================
// 2. BUSCA E AGRUPAMENTO DE PEDIDOS
// ==========================================
try {
    $sql = "SELECT p.id AS pedido_id, p.quantidade, p.idstatus,
                   c.nome AS cliente_nome, 
                   prod.sabor AS produto_sabor, prod.preco AS produto_preco,
                   st.descricao AS status_nome
            FROM pedidos p
            JOIN clientes c ON p.idcliente = c.id
            JOIN produtos prod ON p.idprodutos = prod.id
            LEFT JOIN status_pedidos st ON p.idstatus = st.id
            ORDER BY p.id DESC";
            
    $stmt = $conexao->query($sql);
    $pedidos_brutos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Agrupa os itens por ID do Pedido para montar os cards corretamente
    $pedidos_agrupados = [];
    foreach ($pedidos_brutos as $linha) {
        $id_ped = $linha['pedido_id'];
        
        if (!isset($pedidos_agrupados[$id_ped])) {
            $pedidos_agrupados[$id_ped] = [
                'pedido_id' => $id_ped,
                'cliente' => $linha['cliente_nome'],
                'status_id' => $linha['idstatus'],
                'status_nome' => $linha['status_nome'] ?? 'Em preparo',
                'itens' => [],
                'total_geral' => 0
            ];
        }
        
        $subtotal_item = $linha['quantidade'] * $linha['produto_preco'];
        $pedidos_agrupados[$id_ped]['total_geral'] += $subtotal_item;
        
        $pedidos_agrupados[$id_ped]['itens'][] = [
            'sabor' => $linha['produto_sabor'],
            'quantidade' => $linha['quantidade'],
            'subtotal' => $subtotal_item
        ];
    }

} catch (PDOException $e) {
    $pedidos_agrupados = [];
    $erro_banco = $e->getMessage();
}
?>
<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>L'Art du Pastel - Painel de Pedidos</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        body {
            background-color: #fbf9f9;
            background-image: radial-gradient(#d1c5b4 0.5px, transparent 0.5px), radial-gradient(#d1c5b4 0.5px, #fbf9f9 0.5px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            background-attachment: fixed;
        }
        .paper-overlay { position: fixed; inset: 0; pointer-events: none; background: url('https://www.transparenttextures.com/patterns/natural-paper.png'); opacity: 0.15; z-index: 100; }
        .short-divider { width: 40px; height: 1px; background-color: #c5a059; margin: 1rem auto; }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary": "#775a19",
                        "primary-container": "#c5a059",
                        "surface-container-lowest": "#ffffff",
                        "on-surface": "#1b1c1c",
                        "on-surface-variant": "#4e4639",
                        "outline-variant": "#d1c5b4",
                        "error": "#ba1a1a"
                    }
                },
            },
        }
    </script>
</head>
<body class="font-body-md text-on-surface antialiased overflow-x-hidden">
<div class="paper-overlay"></div>

<?php if (!empty($mensagem_sucesso)): ?>
    <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-emerald-600 text-white px-6 py-3 rounded-xl shadow-2xl font-[Montserrat] text-xs uppercase tracking-wider">
        <?= htmlspecialchars($mensagem_sucesso) ?>
    </div>
<?php endif; ?>

<?php if (!empty($mensagem_erro)): ?>
    <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-error text-white px-6 py-3 rounded-xl shadow-2xl font-[Montserrat] text-xs uppercase tracking-wider">
        <?= htmlspecialchars($mensagem_erro) ?>
    </div>
<?php endif; ?>

<header class="bg-background/80 backdrop-blur-md border-b border-outline-variant z-50 fixed top-0 w-full flex items-center justify-between px-6 md:px-12 h-20">
    <button onclick="window.location.href='../home.php'" class="hover:opacity-70 transition-opacity flex items-center justify-center text-primary">
        <span class="material-symbols-outlined text-3xl">arrow_back</span>
    </button>
    <h1 class="text-3xl text-on-surface uppercase tracking-widest text-center flex-1 font-['Playfair_Display']">
        L'Art du Pastel
    </h1>
    <div class="w-10"></div>
</header>

<main class="pt-32 pb-40 px-6 md:px-12 max-w-4xl mx-auto">
    <section class="text-center mb-12 space-y-4">
        <span class="text-xs text-primary uppercase tracking-[0.2em] font-semibold font-[Montserrat]">Gerenciamento de Cozinha</span>
        <h2 class="text-4xl text-on-surface font-['Playfair_Display'] font-semibold">Painel de Pedidos</h2>
        <div class="short-divider"></div>
    </section>

    <div class="space-y-8">
        <?php if (count($pedidos_agrupados) === 0): ?>
            <div class="text-center py-16 bg-white rounded-2xl border border-outline-variant/40 font-[Montserrat] text-on-surface-variant">
                <span class="material-symbols-outlined text-5xl text-primary/40 mb-3">receipt_long</span>
                <p class="text-base">Nenhum pedido em andamento no momento.</p>
            </div>
        <?php else: ?>
            <?php foreach ($pedidos_agrupados as $ped): ?>
                <div class="bg-surface-container-lowest border border-outline-variant/40 rounded-2xl p-6 md:p-8 shadow-sm space-y-4">
                    
                    <div class="flex justify-between items-start pb-3 border-b border-outline-variant/20">
                        <div>
                            <span class="text-[10px] text-primary font-bold uppercase tracking-wider font-[Montserrat]">Pedido #<?= $ped['pedido_id'] ?></span>
                            <h3 class="text-2xl font-semibold text-on-surface font-['Playfair_Display']"><?= htmlspecialchars($ped['cliente']) ?></h3>
                        </div>
                        
                        <form action="pedidos_delete.php" method="POST" onsubmit="return confirm('Tem certeza de que deseja excluir este pedido?');">
                            <input type="hidden" name="id" value="<?= $ped['pedido_id'] ?>">
                            <button type="submit" class="text-error/40 hover:text-error p-1.5 rounded-lg border border-transparent hover:border-error/20 transition-all flex items-center justify-center" title="Excluir Pedido">
                                <span class="material-symbols-outlined text-2xl">delete</span>
                            </button>
                        </form>
                    </div>

                    <div class="font-[Montserrat] space-y-2">
                        <ul class="space-y-2">
                            <?php foreach ($ped['itens'] as $it): ?>
                                <li class="flex justify-between items-center bg-gray-50/70 p-3 rounded-xl border border-gray-100 text-sm">
                                    <div class="flex items-center gap-3">
                                        <span class="w-6 h-6 bg-primary/10 text-primary rounded-md flex items-center justify-center font-bold text-xs"><?= $it['quantidade'] ?>x</span>
                                        <span class="font-medium text-on-surface"><?= htmlspecialchars($it['sabor']) ?></span>
                                    </div>
                                    <span class="font-semibold text-on-surface-variant">R$ <?= number_format($it['subtotal'], 2, ',', '.') ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between sm:items-center pt-4 border-t border-dashed border-outline-variant/40 gap-4 font-[Montserrat]">
                        
                        <form action="pedidos_update.php" method="POST" class="flex items-center gap-2">
                            <input type="hidden" name="id" value="<?= $ped['pedido_id'] ?>">
                            
                            <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider hidden md:inline">Status:</label>
                            <select name="idstatus" onchange="this.form.submit()" class="text-xs rounded-xl border border-outline-variant/60 focus:ring-1 focus:ring-primary focus:border-primary bg-transparent py-1.5 px-3 font-semibold text-on-surface font-[Montserrat]">
                                <?php foreach ($lista_status as $st): ?>
                                    <option value="<?= $st['id'] ?>" <?= $st['id'] == $ped['status_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($st['descricao']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </form>

                        <div class="text-right">
                            <span class="text-[11px] font-bold uppercase text-on-surface-variant block">Total Geral:</span>
                            <span class="text-2xl font-bold text-primary font-['Playfair_Display']">R$ <?= number_format($ped['total_geral'], 2, ',', '.') ?></span>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<script>
    setTimeout(() => {
        const alertas = document.querySelectorAll('.fixed');
        alertas.forEach(a => a.style.display = 'none');
    }, 4000);
</script>
</body>
</html>