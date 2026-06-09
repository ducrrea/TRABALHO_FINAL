<?php
session_start();

require_once "conexao_bd.php";

$sql = "SELECT * FROM usuarios ORDER BY id";
$resultado = $conexao->query($sql);

?>
<!DOCTYPE html><html class="light" lang="pt-BR" style=""><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>User Management - L'Art du Pastel</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&amp;family=DM+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "on-background": "#1b1c17",
                "secondary-container": "#ffcfcb",
                "surface-container-low": "#f5f4ec",
                "secondary-fixed-dim": "#eabcb8",
                "primary-fixed": "#ffdea5",
                "on-surface-variant": "#4e4639",
                "on-primary-fixed-variant": "#5d4201",
                "on-secondary-fixed": "#2e1413",
                "inverse-primary": "#e9c176",
                "primary-container": "#c5a059",
                "error-container": "#ffdad6",
                "tertiary-fixed-dim": "#dcc497",
                "surface": "#fbf9f1",
                "on-tertiary": "#ffffff",
                "tertiary-container": "#b9a379",
                "secondary-fixed": "#ffdad7",
                "tertiary": "#6e5c37",
                "on-tertiary-fixed": "#261a00",
                "inverse-surface": "#30312c",
                "on-tertiary-container": "#493918",
                "error": "#ba1a1a",
                "surface-container-highest": "#e4e3db",
                "tertiary-fixed": "#f9dfb1",
                "outline": "#7f7667",
                "on-error": "#ffffff",
                "inverse-on-surface": "#f3f1e9",
                "surface-variant": "#e4e3db",
                "background": "#fbf9f1",
                "primary": "#775a19",
                "surface-tint": "#775a19",
                "surface-dim": "#dcdad2",
                "primary-fixed-dim": "#e9c176",
                "on-secondary-container": "#7a5653",
                "surface-bright": "#fbf9f1",
                "secondary": "#795553",
                "on-primary": "#ffffff",
                "surface-container": "#f0eee6",
                "on-primary-fixed": "#261900",
                "outline-variant": "#d1c5b4",
                "surface-container-high": "#eae8e0",
                "on-primary-container": "#4e3700",
                "on-surface": "#1b1c17",
                "on-error-container": "#93000a",
                "surface-container-lowest": "#ffffff",
                "on-tertiary-fixed-variant": "#554422",
                "on-secondary-fixed-variant": "#5f3e3c",
                "on-secondary": "#ffffff"
            },
            "borderRadius": {
                "DEFAULT": "0.25rem",
                "lg": "0.5rem",
                "xl": "0.75rem",
                "full": "9999px"
            },
            "spacing": {
                "margin-desktop": "40px",
                "stack-lg": "48px",
                "container-max": "1200px",
                "stack-sm": "12px",
                "stack-md": "24px",
                "margin-mobile": "20px",
                "gutter": "24px",
                "unit": "8px"
            },
            "fontFamily": {
                "display-lg": ["Playfair Display"],
                "body-lg": ["DM Sans"],
                "button": ["DM Sans"],
                "headline-md": ["Playfair Display"],
                "display-lg-mobile": ["Playfair Display"],
                "label-sm": ["DM Sans"],
                "body-md": ["DM Sans"]
            },
            "fontSize": {
                "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                "display-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                "label-sm": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "500"}],
                "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 10px 40px rgba(140, 120, 81, 0.12);
        }
        .roasted-shadow {
            box-shadow: 0 20px 40px -10px rgba(140, 120, 81, 0.15);
        }
        body {
            background-color: #FFFDF5;
            min-height: 100vh;
        }
        .bg-pastry-mesh {
            background-image: 
                radial-gradient(at 0% 0%, rgba(255, 222, 165, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(121, 85, 83, 0.05) 0px, transparent 50%);
        }
    </style>
</head>
<body class="font-body-md text-on-surface bg-pastry-mesh selection:bg-primary-fixed selection:text-on-primary-fixed">
<header class="sticky top-0 z-50 bg-surface/80 dark:bg-surface-dim/80 backdrop-blur-xl border-b border-outline-variant/30 shadow-[0_10px_40px_rgba(140,120,81,0.15)]">
<div class="flex justify-between items-center w-full px-margin-desktop py-4 max-w-container-max mx-auto">
<div class="flex items-center gap-4">
<a class="group flex items-center justify-center w-10 h-10 rounded-full hover:bg-primary-container/20 transition-all duration-300" href="index.php">
<span class="material-symbols-outlined text-primary" data-icon="arrow_back">arrow_back</span>
</a>
</div>
<div class="absolute left-1/2 -translate-x-1/2 text-center">
<h1 class="font-display-lg text-headline-md tracking-tight text-primary whitespace-nowrap">L'Art du Pastel</h1>
</div>
<div class="flex items-center gap-stack-sm">
<button class="p-2 rounded-full hover:bg-primary-container/20 text-on-surface-variant transition-all duration-300">
<span class="material-symbols-outlined" data-icon="notifications">notifications</span>
</button>
</div>
</div>
</header>
<main class="relative min-h-[calc(100vh-160px)] px-margin-mobile md:px-margin-desktop overflow-hidden py-6 flex flex-col justify-center min-h-[calc(100vh-80px)]">
<div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
<img alt="" class="w-full h-full object-cover blur-2xl scale-110" src="https://lh3.googleusercontent.com/aida/AP1WRLuvdbWVHfLVmpQ11T1EUuNKIIc-FaspOcyDPv5Wf95DqKz_P1w8tL6k-mYH-3LHx1iiJ5ZFAFAXaO3kjGU1HG3LScnW14rShlKlOJonlLRgWdsr7J_GcqsDwH4YrOij78Aln7IwI_T4nhFx6lXWsYvssaKhPDQFvspu71i2ImGTBoZcxKO_8kRgt-1N3uRXvy0Rzwr_Zz-gu-NhVKfELjIUz-BhKsjM8nS6rHD4ZsLBTEK67AsjCvOYHA4">
</div>
<div class="relative z-10 max-w-container-max mx-auto space-y-stack-md w-full">
<div class="flex flex-col gap-2 mb-4">
<span class="text-label-sm font-label-sm uppercase tracking-widest text-primary">Administration</span>
<h2 class="font-display-lg text-display-lg text-on-background">Gestão de Usuários</h2>
</div>
<div class="glass-card rounded-xl overflow-hidden roasted-shadow min-h-[500px]">
<div class="overflow-x-auto">
<table class="w-full text-left border-collapse">
<thead>
<tr class="bg-primary/5">
<th class="px-6 py-5 font-button text-label-sm text-primary uppercase tracking-wider py-8">ID</th>
<th class="px-6 py-5 font-button text-label-sm text-primary uppercase tracking-wider py-8">NOME</th>
</tr>
</thead>
<tbody class="divide-y divide-outline-variant/20">
<?php 
while($usuario = $resultado->fetch(PDO::FETCH_ASSOC)){ 
?>
    <tr class="hover:bg-white/40 transition-colors cursor-pointer group">
        <td class="px-6 py-6 text-on-surface-variant font-body-md py-8">
            #<?php echo str_pad($usuario["id"], 3, "0", STR_PAD_LEFT); ?>
        </td>
        
        <td class="px-6 py-6 py-8">
            <div class="flex items-center gap-3">
                <div class="rounded-full bg-primary-container/30 text-primary flex items-center justify-center font-bold w-12 h-12">
                    <?php echo strtoupper(substr($usuario["nome"], 0, 1)); ?>
                </div>
                
                <?php echo $usuario["nome"]; ?>
            </div>
        </td>
    </tr>
<?php 
} // Fecha o laço de repetição aqui
?>
</tbody>
</table>
</div>
</div>
<div class="flex flex-col sm:flex-row items-center justify-end gap-gutter pt-stack-sm"><form action="usuario_update.php" method="POST" class="w-full sm:w-auto">
<input type="hidden" name="id" value="001">
<button type="submit" class="w-full px-8 py-4 rounded-full border-1.5 border-primary text-primary font-button hover:bg-primary/5 transition-all duration-300 flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[20px]" data-icon="edit">edit</span>
                    Editar
                </button>
</form>
<form action="usuario_create.php" method="POST" class="w-full sm:w-auto">
<button type="submit" class="w-full px-10 py-4 rounded-full bg-primary text-white font-button shadow-lg shadow-primary/20 hover:scale-[1.02] active:scale-95 transition-all duration-300 flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[20px]" data-icon="add">add</span>
                    Adicionar
                </button>
</form>
<form action="usuario_delete.php" method="POST" class="w-full sm:w-auto">
<input type="hidden" name="id" value="001">
<button type="submit" class="w-full px-8 py-4 rounded-full border-1.5 border-error text-error font-button hover:bg-error/5 transition-all duration-300 flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-[20px]" data-icon="delete">delete</span>
                    Deletar
                </button>
</form></div>
</div>
</main>
<script>
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('click', () => {
                document.querySelectorAll('tbody tr').forEach(r => r.classList.remove('bg-primary/10', 'border-l-4', 'border-primary'));
                row.classList.add('bg-primary/10', 'border-l-4', 'border-primary');
            });
        });
    </script>


</body></html>