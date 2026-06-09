<!DOCTYPE html><html class="light" lang="pt-br"><head>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title>Login | L'Art du Pastel</title>
<!-- Fonts -->
<link href="https://fonts.googleapis.com" rel="preconnect">
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;display=swap" rel="stylesheet">
<!-- Icons -->
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "secondary-container": "#ffcfcb",
                    "primary-fixed": "#ffdea5",
                    "tertiary-container": "#b9a379",
                    "on-primary-fixed": "#261900",
                    "primary-fixed-dim": "#e9c176",
                    "surface-container-lowest": "#ffffff",
                    "outline-variant": "#d1c5b4",
                    "on-primary": "#ffffff",
                    "on-background": "#1b1c17",
                    "secondary-fixed": "#ffdad7",
                    "surface-container-low": "#f5f4ec",
                    "error": "#ba1a1a",
                    "inverse-on-surface": "#f3f1e9",
                    "tertiary-fixed": "#f9dfb1",
                    "on-tertiary-fixed-variant": "#554422",
                    "on-primary-fixed-variant": "#5d4201",
                    "on-surface": "#1b1c17",
                    "primary": "#775a19",
                    "background": "#fbf9f1",
                    "primary-container": "#c5a059",
                    "surface-bright": "#fbf9f1",
                    "on-tertiary-container": "#493918",
                    "surface": "#fbf9f1",
                    "outline": "#7f7667",
                    "on-secondary": "#ffffff",
                    "on-surface-variant": "#4e4639",
                    "surface-container-highest": "#e4e3db",
                    "on-secondary-fixed-variant": "#5f3e3c",
                    "on-tertiary-fixed": "#261a00",
                    "tertiary": "#6e5c37",
                    "secondary": "#795553",
                    "surface-container": "#f0eee6",
                    "inverse-surface": "#30312c",
                    "on-error-container": "#93000a",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#7a5653",
                    "surface-container-high": "#eae8e0",
                    "surface-variant": "#e4e3db",
                    "surface-tint": "#775a19",
                    "error-container": "#ffdad6",
                    "tertiary-fixed-dim": "#dcc497",
                    "surface-dim": "#dcdad2",
                    "on-tertiary": "#ffffff",
                    "on-primary-container": "#4e3700",
                    "secondary-fixed-dim": "#eabcb8",
                    "on-secondary-fixed": "#2e1413",
                    "inverse-primary": "#e9c176"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "unit": "8px",
                    "stack-sm": "12px",
                    "gutter": "24px",
                    "margin-mobile": "20px",
                    "stack-md": "24px",
                    "container-max": "1200px",
                    "margin-desktop": "40px",
                    "stack-lg": "48px"
            },
            "fontFamily": {
                    "label-sm": ["DM Sans"],
                    "button": ["DM Sans"],
                    "headline-md": ["Playfair Display"],
                    "display-lg": ["Playfair Display"],
                    "display-lg-mobile": ["Playfair Display"],
                    "body-lg": ["DM Sans"],
                    "body-md": ["DM Sans"]
            },
            "fontSize": {
                    "label-sm": ["14px", {"lineHeight": "1.4", "letterSpacing": "0.05em", "fontWeight": "500"}],
                    "button": ["16px", {"lineHeight": "1", "letterSpacing": "0.02em", "fontWeight": "600"}],
                    "headline-md": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                    "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "display-lg-mobile": ["32px", {"lineHeight": "1.2", "fontWeight": "700"}],
                    "body-lg": ["18px", {"lineHeight": "1.6", "fontWeight": "400"}],
                    "body-md": ["16px", {"lineHeight": "1.5", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        .glass-card {
            background: rgba(255, 253, 245, 0.65);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 30px 60px rgba(89, 67, 25, 0.15);
        }
        .inner-light-stroke {
            box-shadow: inset 1px 1px 0px rgba(255, 255, 255, 0.6), inset -1px -1px 0px rgba(119, 90, 25, 0.05);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        body {
            background-color: #fbf9f1;
        }
        .bg-mesh {
            background-image: radial-gradient(at 0% 0%, rgba(233, 193, 118, 0.15) 0px, transparent 50%),
                              radial-gradient(at 100% 100%, rgba(121, 85, 83, 0.1) 0px, transparent 50%);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col font-body-md text-on-surface bg-mesh">
<!-- TopNavBar -->
<header class="fixed top-0 left-0 right-0 z-50">
<div class="flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop py-stack-md max-w-container-max mx-auto">
<h1 class="font-headline-md text-headline-md text-primary tracking-tight">L'Art du Pastel</h1>
<div class="flex items-center gap-stack-md">
<span class="material-symbols-outlined text-primary cursor-pointer hover:scale-110 transition-transform">shopping_bag</span>
</div>
</div>
</header>
<main class="flex-grow flex items-center justify-center relative overflow-hidden">
<!-- Immersive Background Art -->
<div class="absolute inset-0 pointer-events-none">
<div class="w-full h-full relative">
<img alt="L'Art du Pastel" class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-multiply transition-transform duration-[20s] ease-out" id="bg-art" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBVN9E9oubVYaZpeJV1uvUoS5oKXfUVd6J2kQ03uWIo9USVsge2bUVKR--pBwtMIF4V6pIDp_rFwZZGBRmT1JaSrSPDyyetBX1PcVGLEAbteHR09Ki05rXb84sth9SUecm1jG1pxQz5l6tgLSK3P401JGQDnWAYyEFa_8xT2OnL_pY2ixetHED5ia6ETgo3HcZo4nYpYHdpZMgMhioRLtukqwmXglbu2XdbCncKbCTCnoDeFTvVcgkjThWmVXFtNvyvHmfcK55c9jw" style="transform: scale(1.1) translate(0px, 0px); transition: transform 1.2s cubic-bezier(0.23, 1, 0.32, 1);">
<!-- Sophisticated overlays for depth -->
<div class="absolute inset-0 bg-gradient-to-tr from-background/90 via-background/40 to-transparent"></div>
<div class="absolute inset-0 bg-gradient-to-b from-background/20 via-transparent to-background/60"></div>
</div>
</div>
<!-- Login Container -->
<div class="relative z-10 w-full max-w-[480px] px-margin-mobile">
<div class="glass-card inner-light-stroke rounded-xl p-stack-lg md:p-[48px] flex flex-col items-center" style="transition: 0.6s cubic-bezier(0.23, 1, 0.32, 1); transform: rotateY(0deg) rotateX(0deg);">
<div class="mb-stack-lg text-center">
<div class="w-16 h-16 bg-primary-container/20 rounded-full flex items-center justify-center mb-stack-sm mx-auto">
<span class="material-symbols-outlined text-primary text-[32px]">restaurant</span>
</div>
<h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-unit">Bem-vindo</h2>
<p class="font-body-md text-on-surface-variant max-w-[280px] mx-auto">Sinta a excelência artesanal em cada detalhe de nossa cozinha.</p>
</div>
<form class="w-full space-y-stack-md" action="validar_login.php" method="POST"> 
<div class="space-y-unit">
<label class="font-label-sm text-label-sm text-on-surface-variant block ml-1" for="username">Nome</label>
<div class="relative group">
<input class="w-full bg-white/60 border-outline-variant/50 rounded-lg py-3.5 px-4 focus:ring-2 focus:ring-primary-container/50 focus:border-primary outline-none transition-all placeholder:text-outline/50 font-body-md" id="username" placeholder="Seu usuário" type="text" name="nome">
<span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">person</span>
</div>
</div>
<div class="space-y-unit">
<label class="font-label-sm text-label-sm text-on-surface-variant block ml-1" for="password">Senha</label>
<div class="relative group">
<input class="w-full bg-white/60 border-outline-variant/50 rounded-lg py-3.5 px-4 focus:ring-2 focus:ring-primary-container/50 focus:border-primary outline-none transition-all placeholder:text-outline/50 font-body-md" id="password" placeholder="••••••••" type="password" name="senha">
<span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant group-focus-within:text-primary transition-colors">lock</span>
</div>
</div>
<div class="flex justify-between items-center px-1">
<label class="flex items-center gap-2 cursor-pointer group">
<input class="w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary transition-all" type="checkbox">
<span class="font-label-sm text-label-sm text-on-surface-variant group-hover:text-primary transition-colors">Lembrar de mim</span>
</label>
<a class="font-label-sm text-label-sm text-primary hover:text-primary-container transition-colors" href="#">Esqueci minha senha</a>
</div>
<button class="w-full bg-primary hover:bg-primary-container text-white py-4 rounded-full font-button text-button shadow-lg shadow-primary/20 hover:shadow-primary/40 active:scale-[0.98] transition-all flex items-center justify-center gap-2 mt-stack-md group" type="submit">
                    Entrar
                    <span class="material-symbols-outlined text-[20px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
</form>
<div class="mt-stack-lg text-center pt-stack-md border-t border-outline-variant/20 w-full">
<p class="font-body-md text-on-surface-variant">Não possui uma conta? 
                    <a class="text-primary font-bold hover:underline underline-offset-4 decoration-2 transition-all ml-1" href="#">Criar conta</a>
</p>
</div>
</div>
<!-- Atmospheric Hint -->
<div class="mt-stack-md text-center">
<p class="font-label-sm text-label-sm text-on-surface-variant opacity-40 uppercase tracking-[0.2em]">Desde 1984</p>
</div>
</div>
</main>
<!-- Footer -->
<footer class="w-full relative z-10">
<div class="flex flex-col md:flex-row justify-between items-center w-full px-margin-mobile md:px-margin-desktop py-stack-md max-w-container-max mx-auto">
<p class="font-label-sm text-label-sm text-on-surface-variant opacity-60 mb-stack-sm md:mb-0">© 2024 L'Art du Pastel. Artisanal Excellence.</p>
<div class="flex gap-gutter">
<a class="font-label-sm text-label-sm text-on-surface-variant opacity-60 hover:opacity-100 hover:text-primary transition-all" href="#">Privacidade</a>
<a class="font-label-sm text-label-sm text-on-surface-variant opacity-60 hover:opacity-100 hover:text-primary transition-all" href="#">Termos</a>
<a class="font-label-sm text-label-sm text-on-surface-variant opacity-60 hover:opacity-100 hover:text-primary transition-all" href="#">Contato</a>
</div>
</div>
</footer>
<script>
    // Parallax and subtle animation for immersion
    document.addEventListener('mousemove', (e) => {
        const card = document.querySelector('.glass-card');
        const bgArt = document.querySelector('#bg-art');
        
        const mouseX = e.clientX / window.innerWidth;
        const mouseY = e.clientY / window.innerHeight;

        // Card tilt
        const xAxis = (window.innerWidth / 2 - e.pageX) / 60;
        const yAxis = (window.innerHeight / 2 - e.pageY) / 60;
        card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;

        // Background shift
        const moveX = (mouseX - 0.5) * 20;
        const moveY = (mouseY - 0.5) * 20;
        bgArt.style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
    });

    const card = document.querySelector('.glass-card');
    const bgArt = document.querySelector('#bg-art');
    
    // Initial state
    bgArt.style.transform = 'scale(1.1)';

    document.addEventListener('mouseenter', () => {
        card.style.transition = "none";
    });

    document.addEventListener('mouseleave', () => {
        card.style.transition = "all 0.6s cubic-bezier(0.23, 1, 0.32, 1)";
        card.style.transform = `rotateY(0deg) rotateX(0deg)`;
        bgArt.style.transition = "transform 1.2s cubic-bezier(0.23, 1, 0.32, 1)";
        bgArt.style.transform = `scale(1.1) translate(0, 0)`;
    });
</script>


</body></html>