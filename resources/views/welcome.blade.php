@extends('layout')

@section('content')
<style>
    
    body { font-family: 'Inter', sans-serif; letter-spacing: -0.02em; }
    
    .stat-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(12px);
        border-radius: 35px;
        border: 1px solid white;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.05);
    }

    @media print {
        * { 
            -webkit-print-color-adjust: exact !important; 
            print-color-adjust: exact !important; 
        }
    
        .no-print, button, .blur-3xl { display: none !important; }
        
        .stat-card, .bg-white\/40, .bg-slate-900 {
            background-color: white !important;
            color: black !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: none !important;
            backdrop-filter: none !important;
            page-break-inside: avoid;
        }

        canvas {
            max-width: 100% !important;
            height: 300px !important;
            display: block !important;
        }

        h1, h3, h4, p, span {
            color: black !important;
            background: none !important;
            -webkit-text-fill-color: black !important;
        }
    }
</style>

<div class="max-w-7xl mx-auto space-y-10">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-4">
        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <span class="w-8 h-[2px] bg-blue-500 rounded-full"></span>
                <span class="text-blue-500 font-black text-[10px] uppercase tracking-[0.4em]">Vue d'ensemble</span>
            </div>
            <h1 class="text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-slate-800 to-blue-500 tracking-tight">
                Nexus Dashboard<span class="text-blue-600"></span>
            </h1>
        </div>
        
        <button onclick="printWithDelay()" class="no-print group flex items-center gap-3 bg-white px-8 py-4 rounded-[22px] shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all border border-white">
            <span class="text-slate-400 group-hover:text-blue-500 transition-colors">🖨️</span>
            <span class="text-[11px] font-black uppercase tracking-widest text-slate-500">Exporter Rapport</span>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 px-2">
        <div class="stat-card p-8 shadow-sm">
            <p class="text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Revenue
            </p>
            <h3 class="text-2xl font-extrabold text-slate-800 tracking-tighter">
                {{ number_format($caRealise, 0, '.', ' ') }} <span class="text-[10px] text-slate-300 font-bold ml-1 italic uppercase font-normal">Mad</span>
            </h3>
        </div>

        <div class="stat-card p-8 shadow-sm">
            <p class="text-[10px] font-black text-blue-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Flux Actifs
            </p>
            <h3 class="text-2xl font-extrabold text-slate-800 tracking-tighter">{{ $projetsEnCours }}</h3>
        </div>

        <div class="stat-card p-8 shadow-sm">
            <p class="text-[10px] font-black text-purple-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span> Partenaires
            </p>
            <h3 class="text-2xl font-extrabold text-slate-800 tracking-tighter">{{ $totalClients }}</h3>
        </div>

        <div class="stat-card p-8 shadow-sm">
            <p class="text-[10px] font-black text-orange-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Réussite
            </p>
            <h3 class="text-2xl font-extrabold text-slate-800 tracking-tighter">{{ number_format($tauxReussite, 1) }}%</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 px-2">
        <div class="bg-white/40 backdrop-blur-xl p-10 rounded-[45px] border border-white shadow-xl shadow-slate-200/50 flex flex-col items-center">
            <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.3em] mb-10 italic">Analyse de Répartition</h3>
            <div class="w-full h-72">
                <canvas id="projectChart"></canvas>
            </div>
        </div>
        
        <div class="bg-slate-900 p-12 rounded-[45px] text-white shadow-2xl flex flex-col justify-center relative overflow-hidden group">
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
            
            <p class="text-[10px] font-black uppercase tracking-[0.4em] text-blue-400 mb-6 italic">Focus Stratégique</p>
            <h4 class="text-3xl font-extrabold italic leading-tight uppercase tracking-tight">
                Performance <br> <span class="text-blue-500">Optimale</span> Détectée.
            </h4>
            <p class="mt-4 text-slate-400 text-xs font-medium max-w-xs leading-relaxed">
                Les indicateurs montrent une croissance stable pour ce trimestre.
            </p>
            
            <div class="mt-10 flex gap-3">
                <span class="px-5 py-2.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-2xl text-[9px] font-black tracking-widest uppercase italic">Status: OK</span>
                <span class="px-5 py-2.5 bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 rounded-2xl text-[9px] font-black tracking-widest uppercase italic">Secure</span>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function printWithDelay() {
        window.scrollTo(0, 0);
        setTimeout(function() {
            window.print();
        }, 1200); 
    }

    const ctx = document.getElementById('projectChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['En cours', 'Terminé', 'En attente'],
            datasets: [{
                data: [{{ $projetsEnCours }}, {{ $projetsTermines }}, {{ $projetsEnAttente }}],
                backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                borderWidth: 0,
                hoverOffset: 20
            }]
        },
        options: {
            cutout: '82%',
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                onComplete: function() {
                   
                }
            },
            plugins: {
                legend: { 
                    position: 'bottom', 
                    labels: { 
                        font: { family: 'Inter', weight: '700', size: 10 }, 
                        padding: 25, 
                        usePointStyle: true
                    } 
                }
            }
        }
    });
</script>
@endsection