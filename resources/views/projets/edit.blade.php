<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nexus | Modifier Projet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; 
            height: 100vh; 
            overflow: hidden; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            letter-spacing: -0.02em;
        }

        .edit-card-project { 
            background: white; 
            border-radius: 30px; 
            width: 100%; 
            max-width: 950px; 
            padding: 50px 80px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            position: relative;
        }

       
        .card-accent-project {
            position: absolute;
            top: 0; left: 0; width: 8px; height: 100%;
            background: #2563eb; 
            border-radius: 30px 0 0 30px;
        }

        .input-cute-project {
            width: 100% !important;
            padding: 18px 22px !important;
            border-radius: 12px !important;
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            font-size: 15px !important;
            font-weight: 500 !important;
            color: #1e293b !important;
            transition: all 0.2s ease;
            outline: none;
        }

        .input-cute-project:focus {
            background: white !important;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08) !important;
        }

        .btn-save-project {
            background: #2563eb !important;
            color: white !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            padding: 20px !important;
            border-radius: 12px !important;
            flex: 2;
            border: none !important;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.15) !important;
            transition: 0.3s;
        }

        .btn-cancel {
            background: #f1f5f9 !important;
            color: #64748b !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            padding: 20px !important;
            border-radius: 12px !important;
            flex: 1;
            text-align: center;
            text-decoration: none;
            font-size: 13px;
        }

        .label-cute {
            font-size: 12px; font-weight: 600; color: #64748b; 
            margin-left: 4px; margin-bottom: 8px; display: block;
        }
    
    .btn-save-project {
        background: #2563eb !important;
        color: white !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        padding: 20px !important;
        border-radius: 12px !important;
        flex: 2;
        border: none !important;
        cursor: pointer;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.15) !important;
       
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }

    .btn-save-project:hover {
        background: #1d4ed8 !important;
        transform: translateY(-5px) scale(1.02); 
        box-shadow: 0 15px 30px rgba(37, 99, 235, 0.3) !important;
    }

    .btn-save-project:active {
        transform: translateY(0) scale(0.98); 
    }

    .btn-cancel {
        background: #f1f5f9 !important;
        color: #64748b !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
        padding: 20px !important;
        border-radius: 12px !important;
        flex: 1;
        text-align: center;
        text-decoration: none;
        font-size: 13px;
        transition: all 0.3s ease !important;
    }

    .btn-cancel:hover {
        background: #e2e8f0 !important;
        color: #1e293b !important;
        transform: translateX(-3px);
    }
    </style>
</head>
<body class="antialiased">

    <div class="edit-card-project">
        <div class="card-accent-project"></div>

        <header class="mb-10">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight italic">PROJET<span class="text-blue-600"></span></h1>
            <p class="text-sm text-slate-400 font-medium mt-1">Gestion des paramètres de l'initiative</p>
        </header>

        <form action="{{ route('projets.update', $projet->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="client_id" value="{{ $projet->client_id }}">

            <div class="grid grid-cols-2 gap-8">
                <div class="col-span-2">
                    <label class="label-cute">Nom du Projet</label>
                    <input type="text" name="titre" value="{{ $projet->titre }}" class="input-cute-project" placeholder="Ex: Développement Web">
                </div>

                <div>
                    <label class="label-cute">Budget (DH)</label>
                    <input type="number" step="0.01" name="budget" value="{{ $projet->budget }}" class="input-cute-project" placeholder="0.00">
                </div>

                <div>
                    <label class="label-cute">Statut Actuel</label>
                    <select name="status" class="input-cute-project appearance-none">
                        <option value="En cours" {{ $projet->status == 'En cours' ? 'selected' : '' }}>En cours</option>
                        <option value="En attente" {{ $projet->status == 'En attente' ? 'selected' : '' }}>En attente</option>
                        <option value="Terminé" {{ $projet->status == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center space-x-4 mt-12">
                <button type="submit" class="btn-save-project">Enregistrer les données</button>
                <a href="{{ route('projets.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </div>

</body>
</html>