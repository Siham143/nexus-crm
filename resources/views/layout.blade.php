<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexus CRM - Aesthetic Edition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%); 
            min-height: 100vh; 
        }
       
        .glass-sidebar { 
            background: rgba(255, 255, 255, 0.4); 
            backdrop-filter: blur(20px); 
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 40px;
        }

        .card-glass { 
            background: rgba(255, 255, 255, 0.7); 
            backdrop-filter: blur(10px); 
            border-radius: 35px; 
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05);
        }

        .active-link { 
            background: #3b82f6; 
            color: white !important; 
            box-shadow: 0 8px 16px rgba(59, 130, 246, 0.2);
        }

        @media print {
            aside, .no-print, button, form, nav { display: none !important; }
            main { margin-left: 0 !important; width: 100% !important; padding: 20px !important; background: white !important; }
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased overflow-hidden text-slate-800">
    <div class="flex h-screen p-6 gap-6">
        <aside class="w-72 glass-sidebar flex flex-col shrink-0 no-print shadow-xl overflow-hidden">
            <div class="p-10 mb-2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white font-black italic shadow-md">N</div>
                    <span class="text-2xl font-black text-blue-600 italic tracking-tighter uppercase">NEXUS</span>
                </div>
            </div>

            <nav class="flex-1 px-6 space-y-3 mt-4">
                <a href="{{ route('dashboard') }}" 
                   class="{{ request()->routeIs('dashboard') ? 'active-link' : 'text-slate-500 hover:bg-white/40 hover:text-blue-600' }} flex items-center space-x-4 px-6 py-4 rounded-[22px] transition-all duration-300 font-bold text-sm">
                   <span>📊</span> <span>Dashboard</span>
                </a>
                
                <a href="{{ route('clients.index') }}" 
                   class="{{ request()->routeIs('clients.*') ? 'active-link' : 'text-slate-500 hover:bg-white/40 hover:text-blue-600' }} flex items-center space-x-4 px-6 py-4 rounded-[22px] transition-all duration-300 font-bold text-sm">
                   <span>👥</span> <span>Partenaires</span>
                </a>

                <a href="{{ route('projets.index') }}" 
                   class="{{ request()->routeIs('projets.*') ? 'active-link' : 'text-slate-500 hover:bg-white/40 hover:text-blue-600' }} flex items-center space-x-4 px-6 py-4 rounded-[22px] transition-all duration-300 font-bold text-sm">
                   <span>📂</span> <span>Projets Alpha</span>
                </a>
            </nav>

            <div class="p-8 border-t border-white/40 space-y-4">
                <div class="flex items-center gap-3 px-2">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-black text-blue-600 shadow-inner">S</div>
                    <span class="text-xs font-extrabold text-blue-600/70 tracking-wide uppercase">Siham</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-50 text-red-400 py-3 rounded-[18px] font-black text-[10px] uppercase tracking-widest hover:bg-red-500 hover:text-white transition-all">
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto pr-4 scroll-smooth">
            <div class="max-w-7xl mx-auto">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function printWithDelay() {
            window.scrollTo(0, 0);
            setTimeout(() => { window.print(); }, 800);
        }
    </script>
</body>
</html>