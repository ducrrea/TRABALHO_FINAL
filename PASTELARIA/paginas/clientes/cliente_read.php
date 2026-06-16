<?php
session_start();

// Certifique-se de que o arquivo de conexão está no mesmo diretório
require_once "../conexao_bd.php";

// Busca os clientes trazendo os novos campos cadastrados
$sql = "SELECT * FROM clientes ORDER BY id";
$resultado = $conexao->query($sql);
$total_clientes = $resultado->rowCount();
?>
<!DOCTYPE html>
<html class="light" lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Gestão de Clientes - L'Art du Pastel</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
          tailwind.config = {
            darkMode: "class",
            theme: {
              extend: {
                "colors": {
                    "primary": "#775a19",
                    "primary-container": "#c5a059",
                    "surface": "#fbf9f1",
                    "on-surface": "#1b1c17",
                    "on-surface-variant": "#4e4639",
                    "outline-variant": "#d1c5b4",
                    "background": "#fbf9f1",
                    "error": "#ba1a1a",
                }
              }
            }
          }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        body { background-color: #FFFDF5; min-height: 100vh; }
    </style>
</head>
<body class="font-sans text-on-surface bg-background antialiased">

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 shadow-sm">
    <div class="flex justify-between items-center w-full px-10 py-4 max-w-7xl mx-auto">
        <a class="group flex items-center justify-center w-10 h-10 rounded-full hover:bg-primary-container/20 transition-all" href="../home.php">
            <span class="material-symbols-outlined text-primary">arrow_back</span>
        </a>
        <div class="absolute left-1/2 -translate-x-1/2 text-center">
            <h1 class="font-['Playfair_Display'] text-2xl font-bold tracking-tight text-primary whitespace-nowrap">L'Art du Pastel</h1>
        </div>
        <div class="w-10"></div>
    </div>
</header>

<main class="relative min-h-[calc(100vh-80px)] px-6 md:px-10 py-12 max-w-7xl mx-auto w-full flex flex-col justify-between">
    
    <div class="space-y-8 w-full">
        <div class="flex flex-col gap-2">
            <span class="text-xs font-semibold uppercase tracking-[0.25em] text-primary/70 font-sans">Painel Interno</span>
            <h2 class="font-['Playfair_Display'] text-4xl md:text-5xl font-bold tracking-tight text-on-surface italic pr-4">
                Gestão de Clientes
            </h2>
        </div>

        <?php if ($total_clientes == 0): ?>
            <div class="flex flex-col items-center justify-center py-20 text-center space-y-4">
                <span class="material-symbols-outlined text-6xl text-primary/30">group_off</span>
                <p class="text-lg text-on-surface-variant/60 font-medium">Não tem nenhum cliente cadastrado ainda.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while($cliente = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="glass-card p-6 rounded-2xl shadow-sm hover:shadow-md transition-all border border-outline-variant/20 flex flex-col justify-between space-y-6">
                        <div>
                            <div class="mb-2">
                                <span class="text-xs font-mono font-bold tracking-wider text-primary/60 bg-primary/5 px-2.5 py-1 rounded-md">
                                    ID CLIENTE: #<?php echo str_pad($cliente["id"], 3, "0", STR_PAD_LEFT); ?>
                                </span>
                            </div>
                            
                            <h3 class="font-['Playfair_Display'] text-2xl font-bold text-on-surface mb-4 pt-1">
                                <?php echo $cliente["nome"]; ?>
                            </h3>
                            
                            <div class="space-y-2 border-t border-outline-variant/20 pt-4 text-sm text-on-surface-variant font-medium">
                                <div class="flex justify-between">
                                    <span class="opacity-60">Telefone:</span>
                                    <span><?php echo $cliente["telefone"]; ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="opacity-60">CEP:</span>
                                    <span class="font-mono"><?php echo $cliente["cep"]; ?></span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="opacity-60">Nº Residência:</span>
                                    <span><?php echo $cliente["numerocasa"]; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex gap-3 pt-2">
                            <button onclick="abrirModalEditar(<?php echo htmlspecialchars(json_encode($cliente)); ?>)" class="flex-1 py-2.5 rounded-xl border border-primary text-primary font-medium text-xs uppercase tracking-wider hover:bg-primary/5 transition-all flex items-center justify-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">edit</span> Editar
                            </button>
                            <button onclick="abrirModalDeletar(<?php echo $cliente['id']; ?>, '<?php echo addslashes($cliente['nome']); ?>')" class="flex-1 py-2.5 rounded-xl border border-error text-error font-medium text-xs uppercase tracking-wider hover:bg-error/5 transition-all flex items-center justify-center gap-1.5">
                                <span class="material-symbols-outlined text-sm">delete</span> Deletar
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="flex justify-center pt-12">
        <button onclick="abrirModalCriar()" class="px-8 py-4 rounded-full bg-primary text-white font-semibold text-sm uppercase tracking-widest shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined">add</span> Novo Cliente
        </button>
    </div>
</main>

<div id="modalCriar" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-md">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl border border-outline-variant/30">
        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-primary mb-6">Cadastrar Novo Cliente</h3>
        <form action="cliente_create.php" method="POST" class="space-y-4">
            <input type="hidden" name="acao" value="cadastrar">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">Nome Completo</label>
                <input type="text" name="nome" $_POST['nome'] required class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">CEP</label>
                    <input type="text" name="cep" required placeholder="00000-000" class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">Nº Residência</label>
                    <input type="text" name="numero_residencia" required class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">Telefone / WhatsApp</label>
                <input type="tel" name="telefone" required placeholder="(00) 00000-0000" class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="fecharModais()" class="flex-1 py-3 rounded-xl border border-outline-variant text-on-surface-variant font-medium uppercase tracking-wider text-xs">Cancelar</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-primary text-white font-medium uppercase tracking-wider text-xs shadow-md">Salvar</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEditar" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-md">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl border border-outline-variant/30">
        <h3 class="font-['Playfair_Display'] text-2xl font-bold text-primary mb-6">Editar Cadastro</h3>
        <form id="formEditar" action="cliente_update.php" method="POST" class="space-y-4">
            <input type="hidden" name="acao" value="editar">
            <input type="hidden" name="id" id="edit_id">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">Nome do Cliente</label>
                <input type="text" name="nome" id="edit_nome" required class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">CEP</label>
                    <input type="text" name="cep" id="edit_cep" required class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">Nº Residência</label>
                    <input type="text" name="numero_residencia" id="edit_numero_residencia" required class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-on-surface-variant mb-2">Telefone</label>
                <input type="tel" name="telefone" id="edit_telefone" required class="w-full rounded-xl border-outline-variant/50 focus:border-primary focus:ring-primary">
            </div>
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="fecharModais()" class="flex-1 py-3 rounded-xl border border-outline-variant text-on-surface-variant font-medium uppercase tracking-wider text-xs">Cancelar</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-primary text-white font-medium uppercase tracking-wider text-xs shadow-md">Atualizar</button>
            </div>
        </form>
    </div>
</div>

<div id="modalDeletar" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-md">
    <div class="bg-white rounded-2xl max-w-md w-full p-8 shadow-2xl border border-outline-variant/30 text-center space-y-6">
        <div class="w-16 h-16 bg-error/10 text-error rounded-full flex items-center justify-center mx-auto">
            <span class="material-symbols-outlined text-3xl">delete_forever</span>
        </div>
        <div>
            <h3 class="font-['Playfair_Display'] text-2xl font-bold text-on-surface mb-2">Excluir Cliente?</h3>
            <p class="text-sm text-on-surface-variant">Tem certeza que deseja remover <span id="delete_nome_remover" class="font-bold text-on-surface"></span>? Esta operação não pode ser desfeita.</p>
        </div>
        
        <form action="cliente_delete.php" method="POST">
            <input type="hidden" name="id" id="delete_id">
            <div class="flex gap-3">
                <button type="button" onclick="fecharModais()" class="flex-1 py-3 rounded-xl border border-outline-variant text-on-surface-variant font-medium uppercase tracking-wider text-xs">Voltar</button>
                <button type="submit" class="flex-1 py-3 rounded-xl bg-error text-white font-medium uppercase tracking-wider text-xs shadow-md">Sim, Remover</button>
            </div>
        </form>
    </div>
</div>
<script>
    function abrirModalCriar() {
        document.getElementById('modalCriar').classList.remove('hidden');
    }

    function abrirModalEditar(cliente) {
        document.getElementById('edit_id').value = cliente.id;
        document.getElementById('edit_nome').value = cliente.nome;
        document.getElementById('edit_cep').value = cliente.cep || '';
        document.getElementById('edit_numero_residencia').value = cliente.numero_residencia || '';
        document.getElementById('edit_telefone').value = cliente.telefone || '';
        document.getElementById('modalEditar').classList.remove('hidden');
    }

    function abrirModalDeletar(id, nome) {
        document.getElementById('delete_id').value = id;
        document.getElementById('delete_nome_remover').innerText = nome;
        document.getElementById('modalDeletar').classList.remove('hidden');
    }

    function fecharModais() {
        document.getElementById('modalCriar').classList.add('hidden');
        document.getElementById('modalEditar').classList.add('hidden');
        document.getElementById('modalDeletar').classList.add('hidden');
    }

    window.onclick = function(event) {
        const modais = ['modalCriar', 'modalEditar', 'modalDeletar'];
        modais.forEach(id => {
            const modal = document.getElementById(id);
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });
    }
</script>
</body>
</html>