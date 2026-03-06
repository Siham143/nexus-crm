<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nexus CRM | Modifier Partenaire</title>
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

        .edit-card-dashboard { 
            background: white; 
            border-radius: 30px; 
            width: 100%; 
            max-width: 950px; 
            padding: 60px 80px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
            position: relative;
        }

        .card-accent {
            position: absolute;
            top: 0; left: 0; width: 8px; height: 100%;
            background: #2563eb; 
            border-radius: 30px 0 0 30px;
        }

        .input-dashboard-style {
            width: 100% !important;
            padding: 18px 22px !important;
            border-radius: 12px !important;
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            font-size: 15px !important;
            font-weight: 500 !important;
            color: #1e293b !important;
            transition: all 0.2s ease;
        }

        .input-dashboard-style:focus {
            background: white !important;
            border-color: #2563eb !important;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.08) !important;
            outline: none;
        }

        .btn-dashboard {
            background: #2563eb !important;
            color: white !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            padding: 20px !important;
            border-radius: 12px !important;
            width: 100% !important;
            border: none !important;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.15) !important;
            transition: 0.3s;
        }

        .btn-dashboard:hover {
            background: #1d4ed8 !important;
            transform: translateY(-1px);
        }

        .label-dashboard {
            font-size: 12px; font-weight: 600; color: #64748b; 
            margin-left: 4px; margin-bottom: 8px; display: block;
        }
    </style>
</head>
<body class="antialiased">

    <div class="edit-card-dashboard">
        <div class="card-accent"></div>

        <a href="{{ url('/clients') }}" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 transition-all mb-8 font-bold text-sm">
            <span>←</span> 
            <span>Retour au CRM</span>
        </a>

        <header class="mb-10">
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">EDITION<span class="text-blue-600"></span></h1>
            <p class="text-sm text-slate-400 font-medium mt-1">Mise à jour des informations du partenaire</p>
        </header>

        <form action="/clients/{{ $client->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-8">
                <div class="col-span-2">
                    <label class="label-dashboard">Nom de l'Entreprise</label>
                    <input type="text" name="nom_entreprise" value="{{ $client->nom_entreprise }}" class="input-dashboard-style">
                </div>

                <div>
                    <label class="label-dashboard">Email de Contact</label>
                    <input type="email" name="email" value="{{ $client->email }}" class="input-dashboard-style">
                </div>

                <div>
                    <label class="label-dashboard">Ligne Directe</label>
                    <input type="text" name="telephone" value="{{ $client->telephone }}" class="input-dashboard-style">
                </div>
            </div>

            <div class="mt-10">
                <button type="submit" class="btn-dashboard">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>

</body>
</html>