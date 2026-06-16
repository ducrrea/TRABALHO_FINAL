<?php
session_start();
require_once "../conexao_bd.php";
$mensagem_sucesso = "";
$mensagem_erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- AÇÃO: CADASTRAR PRODUTO ---
    if (isset($_POST['acao_cadastrar'])) {
        $sabor = trim($_POST['sabor'] ?? '');
        $preco = floatval($_POST['preco'] ?? 0);
        $tipo = true; // CORRIGIDO: Passa um valor BOOLEAN (true) exigido pelo seu PostgreSQL

        if (!empty($sabor) && $preco > 0) {
            try {
                $sql = "INSERT INTO produtos (tipo, sabor, preco) VALUES (:tipo, :sabor, :preco)";
                $stmt = $conexao->prepare($sql);
                $stmt->bindValue(':tipo', $tipo, PDO::PARAM_BOOL); // Força o envio como Boolean seguro
                $stmt->bindParam(':sabor', $sabor);
                $stmt->bindParam(':preco', $preco);
                
                if ($stmt->execute()) {
                    header("Location: produtos_read.php?sucesso=cadastrado");
                    exit();
                }
            } catch (PDOException $e) {
                $mensagem_erro = "Erro ao cadastrar no PostgreSQL: " . $e->getMessage();
            }
        } else {
            $mensagem_erro = "Por favor, preencha o sabor e o preço corretamente.";
        }
    }

    // --- AÇÃO: EDITAR PRODUTO ---
    if (isset($_POST['acao_editar'])) {
        $id = intval($_POST['id'] ?? 0);
        $sabor = trim($_POST['sabor'] ?? '');
        $preco = floatval($_POST['preco'] ?? 0);
        $tipo = true; // Mantém ativo na edição

        if (!empty($id) && !empty($sabor) && $preco > 0) {
            try {
                $sql = "UPDATE produtos SET tipo = :tipo, sabor = :sabor, preco = :preco WHERE id = :id";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindValue(':tipo', $tipo, PDO::PARAM_BOOL);
                $stmt->bindParam(':sabor', $sabor);
                $stmt->bindParam(':preco', $preco);
                
                if ($stmt->execute()) {
                    header("Location: produtos_read.php?sucesso=editado");
                    exit();
                }
            } catch (PDOException $e) {
                $mensagem_erro = "Erro ao atualizar no PostgreSQL: " . $e->getMessage();
            }
        } else {
            $mensagem_erro = "Dados inválidos para edição.";
        }
    }

    // --- AÇÃO: DELETAR PRODUTO ---
    if (isset($_POST['acao_deletar'])) {
        $id = intval($_POST['id'] ?? 0);
        if (!empty($id)) {
            try {
                $sql = "DELETE FROM produtos WHERE id = :id";
                $stmt = $conexao->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if ($stmt->execute()) {
                    header("Location: produtos_read.php?sucesso=deletado");
                    exit();
                }
            } catch (PDOException $e) {
                $mensagem_erro = "Não é possível remover este sabor pois faz parte de pedidos existentes.";
            }
        }
    }
}

// Captura mensagens de retorno bem-sucedidas
if (isset($_GET['sucesso'])) {
    if ($_GET['sucesso'] == 'cadastrado') $mensagem_sucesso = "Sabor artesanal cadastrado com sucesso!";
    if ($_GET['sucesso'] == 'editado') $mensagem_sucesso = "Sabor atualizado com sucesso!";
    if ($_GET['sucesso'] == 'deletado') $mensagem_sucesso = "Sabor removido do menu com sucesso!";
}

// ==========================================
// 2. BUSCA DE DADOS (CLIENTES E PRODUTOS)
// ==========================================
try {
    $sql_clientes = "SELECT id, nome FROM clientes ORDER BY nome";
    $stmt_clientes = $conexao->query($sql_clientes);
    $clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $clientes = [];
}

try {
    $sql_produtos = "SELECT id, tipo, sabor, preco FROM produtos ORDER BY id ASC";
    $stmt_produtos = $conexao->query($sql_produtos);
    $produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $produtos = [];
}
?>
<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>L'Art du Pastel - Menu</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        body {
            background-color: #fbfbf9;
            background-image: radial-gradient(#d1c5b4 0.5px, transparent 0.5px), radial-gradient(#d1c5b4 0.5px, #fbfbf9 0.5px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            background-attachment: fixed;
        }
        .paper-overlay { position: fixed; inset: 0; pointer-events: none; background: url('https://www.transparenttextures.com/patterns/natural-paper.png'); opacity: 0.15; z-index: 100; }
        .flavor-card { transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
        .flavor-card:hover { transform: translateY(-8px); }
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
    <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-error text-white px-6 py-4 rounded-xl shadow-2xl font-[Montserrat] text-sm text-center max-w-xl">
        <strong>Atenção:</strong> <?= $mensagem_erro ?>
    </div>
<?php endif; ?>

<header class="bg-background/80 backdrop-blur-md border-b border-outline-variant z-50 fixed top-0 w-full flex items-center justify-between px-6 md:px-12 h-20">
    <button onclick="window.location.href='../home.php'" class="hover:opacity-70 transition-opacity flex items-center justify-center text-primary">
        <span class="material-symbols-outlined text-3xl">arrow_back</span>
    </button>
    <h1 class="text-3xl text-on-surface uppercase tracking-widest text-center flex-1 font-['Playfair_Display']">
        L'Art du Pastel
    </h1>
    <button onclick="abrirModalCriarProduto()" class="bg-primary text-white text-xs px-6 py-2 uppercase tracking-widest hover:opacity-90 font-[Montserrat]">Adicionar Produto</button>
</header>

<main class="pt-32 pb-40 px-6 md:px-12 max-w-7xl mx-auto">
    <section class="text-center mb-16 space-y-4">
        <span class="text-xs text-primary uppercase tracking-[0.2em] font-semibold font-[Montserrat]">Seleção Exclusiva</span>
        <h2 class="text-4xl md:text-5xl text-on-surface font-['Playfair_Display'] font-semibold">Menu de Sabores</h2>
        <div class="short-divider"></div>
    </section>

    <section class="bg-white/80 backdrop-blur-sm p-6 rounded-2xl border border-outline-variant/30 max-w-3xl mx-auto mb-16 space-y-6 shadow-sm">
        <h3 class="font-['Playfair_Display'] text-xl font-bold text-primary flex items-center gap-2">
            <span class="material-symbols-outlined">shopping_basket</span> 1. Iniciar Pedido Automatizado
        </h3>
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface-variant mb-2 font-[Montserrat]">Selecione o Cliente:</label>
            <select id="selectCliente" onchange="atualizarClientePedido()" class="w-full p-3 rounded-xl border border-outline-variant/60 focus:ring-1 focus:ring-primary focus:border-primary bg-transparent text-sm font-[Montserrat]">
                <option value="">-- Escolha um cliente cadastrado --</option>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="areaSacola" class="hidden border-t border-dashed border-outline-variant/60 pt-4 space-y-4 font-[Montserrat]">
            <h4 class="text-xs font-bold uppercase tracking-wider text-primary">Sacola de Compras: <span id="nomeClientePedido" class="text-on-surface"></span></h4>
            <ul id="listaItensPedido" class="space-y-2 text-sm text-on-surface-variant"></ul>
            <div class="flex justify-between items-center font-bold text-base text-on-surface pt-2 border-t border-outline-variant/20">
                <span>Total:</span>
                <span>R$ <span id="totalPedido">0,00</span></span>
            </div>
            <form action="./pedidos/pedido_create.php" method="POST">
                <input type="hidden" name="cliente_id" id="form_cliente_id">
                <input type="hidden" name="itens_produtos" id="form_itens_produtos">
                <button type="submit" class="w-full py-3 bg-primary text-white font-medium rounded-xl hover:opacity-90 text-xs uppercase tracking-wider shadow-md">
                    Finalizar e Registrar Pedido
                </button>
            </form>
        </div>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        <?php if (count($produtos) === 0): ?>
            <div class="col-span-full text-center py-12 font-[Montserrat] text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl text-primary mb-2">layers_clear</span>
                <p>Nenhum sabor cadastrado no cardápio. Adicione o seu primeiro pastel acima!</p>
            </div>
        <?php else: ?>
            <?php foreach ($produtos as $p): ?>
            <article class="flavor-card group bg-surface-container-lowest border border-outline-variant/30 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="relative aspect-[1.79] overflow-hidden bg-gray-100">
                    </div> 
                    <div class="p-8 text-center space-y-3">
                        <span class="text-[10px] bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full uppercase tracking-wider font-semibold font-[Montserrat]">Disponível</span>
                        <h3 class="font-['Playfair_Display'] text-2xl font-medium text-on-surface pt-1"><?= htmlspecialchars($p['sabor']) ?></h3>
                    </div>
                </div>
                
                <div class="p-8 pt-0 text-center space-y-4">
                    <div class="text-primary font-['Playfair_Display'] text-xl font-medium">
                        R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                    </div>
                    
                    <div class="flex flex-col gap-2 font-[Montserrat]">
                        <button type="button" onclick="adicionarAoPedido(<?= $p['id'] ?>, '<?= htmlspecialchars($p['sabor']) ?>', <?= $p['preco'] ?>)" class="w-full py-2.5 bg-on-surface text-white rounded-xl text-xs uppercase tracking-widest hover:opacity-90 flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-base">add_shopping_cart</span> Adicionar ao Pedido
                        </button>
                        <div class="flex gap-2">
                            <button type="button" onclick="abrirModalEditarProduto(<?= htmlspecialchars(json_encode($p)) ?>)" class="flex-1 py-2 rounded-xl border border-outline-variant text-on-surface-variant text-[10px] uppercase tracking-widest hover:bg-gray-50">
                                Editar
                            </button>
                            <button type="button" onclick="abrirModalDeletarProduto(<?= $p['id'] ?>, '<?= htmlspecialchars($p['sabor']) ?>')" class="flex-1 py-2 rounded-xl border border-error/30 text-error text-[10px] uppercase tracking-widest hover:bg-error/5">
                                Deletar
                            </button>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<div id="modalCriarProduto" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 space-y-6 shadow-2xl font-[Montserrat]">
        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-primary">Novo Sabor</h3>
        <form action="" method="POST" class="space-y-4 text-sm">
            <input type="hidden" name="acao_cadastrar" value="1">
            <div>
                <label class="block text-xs font-semibold mb-1 text-on-surface-variant">Nome do Sabor:</label>
                <input type="text" name="sabor" placeholder="Ex: Queijo Cremoso com Alho Poró" required class="w-full p-3 rounded-xl border border-outline-variant">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1 text-on-surface-variant">Preço (R$):</label>
                <input type="number" step="0.01" name="preco" placeholder="0.00" required class="w-full p-3 rounded-xl border border-outline-variant">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="fecharModais()" class="flex-1 py-3 border rounded-xl text-xs uppercase tracking-widest">Cancelar</button>
                <button type="submit" class="flex-1 py-3 bg-primary text-white rounded-xl text-xs uppercase tracking-widest shadow-md">Cadastrar</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditarProduto" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 space-y-6 shadow-2xl font-[Montserrat]">
        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-primary">Editar Produto</h3>
        <form action="" method="POST" class="space-y-4 text-sm">
            <input type="hidden" name="acao_editar" value="1">
            <input type="hidden" name="id" id="edit_prod_id">
            <div>
                <label class="block text-xs font-semibold mb-1 text-on-surface-variant">Nome do Sabor:</label>
                <input type="text" name="sabor" id="edit_prod_sabor" required class="w-full p-3 rounded-xl border border-outline-variant">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1 text-on-surface-variant">Preço (R$):</label>
                <input type="number" step="0.01" name="preco" id="edit_prod_preco" required class="w-full p-3 rounded-xl border border-outline-variant">
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="fecharModais()" class="flex-1 py-3 border rounded-xl text-xs uppercase tracking-widest">Cancelar</button>
                <button type="submit" class="flex-1 py-3 bg-primary text-white rounded-xl text-xs uppercase tracking-widest shadow-md">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div id="modalDeletarProduto" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 text-center space-y-6 shadow-2xl font-[Montserrat]">
        <div class="w-14 h-14 bg-error/10 text-error rounded-full flex items-center justify-center mx-auto">
            <span class="material-symbols-outlined text-3xl">delete_forever</span>
        </div>
        <h3 class="font-['Playfair_Display'] text-2xl font-bold">Excluir Sabor?</h3>
        <p class="text-sm text-on-surface-variant">Tem certeza que deseja apagar <span id="delete_prod_nome" class="font-bold"></span>?</p>
        <form action="" method="POST">
            <input type="hidden" name="acao_deletar" value="1">
            <input type="hidden" name="id" id="delete_prod_id">
            <div class="flex gap-3">
                <button type="button" onclick="fecharModais()" class="flex-1 py-3 border rounded-xl text-xs uppercase tracking-widest">Voltar</button>
                <button type="submit" class="flex-1 py-3 bg-error text-white rounded-xl text-xs uppercase tracking-widest shadow-md">Remover</button>
            </div>
        </form>
    </div>
</div>

<script>
    let sacola = [];

    function atualizarClientePedido() {
        const select = document.getElementById('selectCliente');
        const areaSacola = document.getElementById('areaSacola');
        const nomeCliente = document.getElementById('nomeClientePedido');
        const formClienteId = document.getElementById('form_cliente_id');

        if (select.value !== "") {
            areaSacola.classList.remove('hidden');
            nomeCliente.innerText = select.options[select.selectedIndex].text;
            formClienteId.value = select.value;
        } else {
            areaSacola.classList.add('hidden');
            sacola = [];
            renderizarSacola();
        }
    }

    function adicionarAoPedido(id, nome, preco) {
        const clienteSelecionado = document.getElementById('selectCliente').value;
        if (!clienteSelecionado) {
            alert('Por favor, selecione um cliente antes de adicionar os pastéis!');
            return;
        }
        const itemExistente = sacola.find(item => item.id === id);
        if (itemExistente) { itemExistente.quantidade++; } 
        else { sacola.push({ id: id, nome: nome, preco: preco, tracking: 1, quantidade: 1 }); }
        renderizarSacola();
    }

    function renderizarSacola() {
        const lista = document.getElementById('listaItensPedido');
        const totalSpan = document.getElementById('totalPedido');
        const formItens = document.getElementById('form_itens_produtos');
        lista.innerHTML = "";
        let total = 0;
        sacola.forEach(item => {
            const subtotal = item.preco * item.quantidade;
            total += subtotal;
            const li = document.createElement('li');
            li.className = "flex justify-between items-center bg-gray-50 p-2.5 rounded-xl border";
            li.innerHTML = `<span><strong>${item.quantidade}x</strong> ${item.nome}</span><strong>R$ ${subtotal.toFixed(2).replace('.', ',')}</strong>`;
            lista.appendChild(li);
        });
        totalSpan.innerText = total.toFixed(2).replace('.', ',');
        formItens.value = JSON.stringify(sacola);
    }

    function abrirModalCriarProduto() { document.getElementById('modalCriarProduto').classList.remove('hidden'); }
    function abrirModalEditarProduto(p) {
        document.getElementById('edit_prod_id').value = p.id;
        document.getElementById('edit_prod_sabor').value = p.sabor;
        document.getElementById('edit_prod_preco').value = p.preco;
        document.getElementById('modalEditarProduto').classList.remove('hidden');
    }
    function abrirModalDeletarProduto(id, nome) {
        document.getElementById('delete_prod_id').value = id;
        document.getElementById('delete_prod_nome').innerText = nome;
        document.getElementById('modalDeletarProduto').classList.remove('hidden');
    }
    function fecharModais() {
        document.getElementById('modalCriarProduto').classList.add('hidden');
        document.getElementById('modalEditarProduto').classList.add('hidden');
        document.getElementById('modalDeletarProduto').classList.add('hidden');
    }

    setTimeout(() => {
        const alertas = document.querySelectorAll('.fixed.top-24');
        alertas.forEach(a => a.style.display = 'none');
    }, 4000);
</script>
</body>
</html>