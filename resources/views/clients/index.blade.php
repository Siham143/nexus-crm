@extends('layout')

@section('title', 'Répertoire Partenaires - Soft Edition')

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

    .table-container-cute {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(10px);
        border-radius: 40px;
        border: 1px solid white;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.02);
        overflow: visible !important; 
    }

    .partner-name-fix {
        color: #1e293b !important;
        font-weight: 800 !important;
        font-size: 1.1rem !important;
        display: block !important;
        -webkit-text-fill-color: #1e293b !important;
    }

    @media print {
       
        .max-w-7xl { max-width: 100% !important; width: 100% !important; margin: 0 !important; }
        .table-container-cute { 
            background: white !important; 
            box-shadow: none !important; 
            border: none !important;
            overflow: visible !important; 
            backdrop-filter: none !important;
        }
        .partner-name-fix { color: black !important; -webkit-text-fill-color: black !important; }
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
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
                Partenaires<span class="text-blue-500"></span>
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
            <h3 class="text-xs font-black text-slate-700 uppercase tracking-widest italic">Nouveau Partenaire</h3>
        </div>
        <form action="{{ route('clients.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-5 items-end">
            @csrf
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-3 mb-2 block uppercase">Nom Société</label>
                <input type="text" name="nom_entreprise" class="input-cute-bordered" placeholder="Ex: Nexus Agency" required>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-3 mb-2 block uppercase">E-mail</label>
                <input type="email" name="email" class="input-cute-bordered" placeholder="contact@..." required>
            </div>
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-3 mb-2 block uppercase">Téléphone</label>
                <input type="text" name="telephone" class="input-cute-bordered" placeholder="06..." required>
            </div>
            <button type="submit" class="bg-slate-900 text-white rounded-[18px] py-4 font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition-all h-[52px]">
                Ajouter
            </button>
        </form>
    </div>

    <div class="table-container-cute">
        <table class="w-full">
            <thead>
                <tr class="text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-50/50">
                    <th class="px-10 py-7 text-left">Partenaire</th>
                    <th class="px-6 py-7 text-center">Contact</th>
                    <th class="px-6 py-7 text-center">Projets</th>
                    <th class="px-10 py-7 text-right no-print">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($clients as $client)
                <tr x-show="'{{ strtolower($client->nom_entreprise) }}'.includes(search.toLowerCase())" 
                    class="hover:bg-white/60 transition-all group">
                    <td class="px-10 py-8">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 bg-blue-600 text-white rounded-2xl flex items-center justify-center font-black">
                                {{ substr($client->nom_entreprise, 0, 1) }}
                            </div>
                            <div>
                                <div class="partner-name-fix">{{ $client->nom_entreprise }}</div>
                                <div class="text-blue-500/60 text-[10px] font-extrabold uppercase mt-1">Société Partenaire</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-8 text-center">
                        <div class="text-slate-700 font-bold text-sm">{{ $client->email }}</div>
                        <div class="text-[10px] text-slate-400 font-bold">{{ $client->telephone }}</div>
                    </td>
                    <td class="px-6 py-8 text-center">
                        <span class="px-4 py-2 bg-slate-50 text-slate-500 font-bold text-[10px] rounded-xl border border-white">
                            {{ $client->projets->count() }} Projets
                        </span>
                    </td>
                    <td class="px-10 py-8 text-right no-print">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('clients.edit', $client->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg">✏️</a>
                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                @csrf @method('DELETE')
                                <button class="p-2 text-red-400 hover:bg-red-50 rounded-lg">🗑️</button>
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