@extends('layout')

@section('title', 'Flux Alpha - Clear Magic')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    body { 
        font-family: 'Inter', sans-serif; 
        background-color: #f8fafc; 
        letter-spacing: -0.02em; 
    }

    .input-cute-bordered {
        width: 100% !important;
        padding: 14px 20px !important;
        border-radius: 16px !important;
        background-color: white !important;
        border: 2px solid #e2e8f0 !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #1e293b !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        outline: none !important;
    }

    .input-cute-bordered:focus {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.08) !important;
        transform: translateY(-1px);
    }

    .label-cute {
        font-size: 10px !important;
        font-weight: 800 !important;
        color: #94a3b8 !important;
        margin-left: 10px !important;
        margin-bottom: 6px !important;
        display: block !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
    }

    .table-container-cute {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(10px);
        border-radius: 40px;
        border: 1px solid white;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.02);
        overflow: hidden; 
    }

    @media print {
        .no-print, form, .flex.items-center.gap-4, .relative.group { 
            display: none !important; 
        }
        
        .max-w-7xl { 
            max-width: 100% !important; 
            width: 100% !important; 
            margin: 0 !important; 
            padding: 0 !important; 
        }

        .table-container-cute { 
            background: white !important; 
            box-shadow: none !important; 
            border: none !important;
            overflow: visible !important; 
            backdrop-filter: none !important;
            margin: 0 !important;
        }

        table { 
            width: 100% !important; 
            border-collapse: collapse !important; 
        }

        tr { 
            page-break-inside: avoid !important; 
        }

        td, th { 
            border-bottom: 1px solid #f1f5f9 !important; 
            padding: 15px 10px !important;
        }

        * { 
            -webkit-print-color-adjust: exact !important; 
            print-color-adjust: exact !important; 
        }
    }
</style>

<div x-data="{ search: '' }" class="max-w-7xl mx-auto space-y-10 pb-20">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 px-4">
        <div class="space-y-2">
            <div class="flex items-center gap-2">
                <span class="w-8 h-[2px] bg-blue-500 rounded-full"></span>
                <span class="text-blue-500 font-black text-[10px] uppercase tracking-[0.4em]">Operational Center</span>
            </div>
            <h1 class="text-5xl font-black text-slate-900 tracking-tighter">
                Flux de Travail<span class="text-blue-500"></span>
            </h1>
        </div>
        
        <div class="flex items-center gap-4 no-print">
            <div class="relative group">
                <input x-model="search" type="text" placeholder="Rechercher..." 
                    class="w-64 pl-12 pr-6 py-4 bg-white border-2 border-transparent rounded-[22px] text-sm font-bold shadow-sm focus:border-blue-100 transition-all outline-none">
                <span class="absolute left-5 top-4.5 opacity-30 text-lg">🔍</span>
            </div>
            <button onclick="window.print()" class="p-4 bg-white rounded-[20px] shadow-sm hover:shadow-md transition-all text-blue-500 border border-slate-50 font-bold text-xs uppercase px-6">
                🖨️ Exporter PDF
            </button>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-md rounded-[35px] p-8 border border-white shadow-sm no-print">
        <div class="flex items-center gap-3 mb-8 ml-2">
            <span class="p-2 bg-blue-500/10 rounded-xl text-blue-500 text-sm font-bold">✨</span>
            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest italic">Lancer un nouveau flux</h3>
        </div>
        
        <form action="{{ route('projets.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-5 items-end">
            @csrf
            <div class="md:col-span-1">
                <label class="label-cute">Nom Projet</label>
                <input type="text" name="titre" class="input-cute-bordered" placeholder="Ex: Refonte" required>
            </div>
            
            <div>
                <label class="label-cute">Partenaire</label>
                <select name="client_id" class="input-cute-bordered appearance-none cursor-pointer" required>
                    <option value="">Choisir...</option>
                    @foreach($clients as $client) <option value="{{ $client->id }}">{{ $client->nom_entreprise }}</option> @endforeach
                </select>
            </div>
            
            <div>
                <label class="label-cute">Budget (MAD)</label>
                <input type="number" name="budget" class="input-cute-bordered" placeholder="00.00">
            </div>
            
            <div>
                <label class="label-cute">Deadline</label>
                <input type="date" name="deadline" class="input-cute-bordered">
            </div>
            
            <div>
                <label class="label-cute">Status</label>
                <select name="status" class="input-cute-bordered">
                    <option value="En cours">En cours</option>
                    <option value="En attente">En attente</option>
                    <option value="Terminé">Terminé</option>
                </select>
            </div>
            
            <button type="submit" class="bg-slate-900 text-white rounded-[18px] py-4 font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition-all shadow-lg shadow-slate-200 h-[52px]">
                Lancer
            </button>
        </form>
    </div>

    <div class="table-container-cute">
        <table class="w-full">
            <thead>
                <tr class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-50/50">
                    <th class="px-10 py-7 text-left">Information</th>
                    <th class="px-6 py-7 text-center">Budget</th>
                    <th class="px-6 py-7 text-center">Echéance</th>
                    <th class="px-6 py-7 text-center">Etat</th>
                    <th class="px-10 py-7 text-right no-print">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($projets as $projet)
                <tr x-show="'{{ strtolower($projet->titre) }}'.includes(search.toLowerCase())" 
                    class="hover:bg-white/60 transition-all group">
                    <td class="px-10 py-8">
                        <div class="text-slate-800 font-bold text-base tracking-tight">{{ $projet->titre }}</div>
                        <div class="text-blue-500/60 text-[10px] font-extrabold uppercase mt-1">{{ $projet->client->nom_entreprise ?? 'Alpha Node' }}</div>
                    </td>
                    <td class="px-6 py-8 text-center font-bold text-slate-700 text-sm">
                        {{ number_format($projet->budget, 0, '.', ' ') }} <small class="text-slate-300 font-medium italic">DH</small>
                    </td>
                    <td class="px-6 py-8 text-center">
                        <span class="px-4 py-2 bg-slate-50 text-slate-500 font-bold text-[10px] rounded-xl border border-white">
                            {{ $projet->deadline ? \Carbon\Carbon::parse($projet->deadline)->format('d M') : '--' }}
                        </span>
                    </td>
                    <td class="px-6 py-8 text-center">
                        <span class="px-5 py-2 rounded-full text-[9px] font-black uppercase tracking-widest
                            {{ $projet->status == 'Terminé' ? 'bg-emerald-50 text-emerald-500' : 
                               ($projet->status == 'En cours' ? 'bg-blue-50 text-blue-500' : 'bg-orange-50 text-orange-500') }}">
                            {{ $projet->status }}
                        </span>
                    </td>
                    <td class="px-10 py-8 text-right no-print">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('projets.edit', $projet->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-all">✏️</a>
                            <form action="{{ route('projets.destroy', $projet->id) }}" method="POST" onsubmit="return confirm('Confirmer ?')">
                                @csrf @method('DELETE')
                                <button class="p-2 text-red-400 hover:bg-red-50 rounded-lg transition-all">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection