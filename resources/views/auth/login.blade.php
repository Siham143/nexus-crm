<x-guest-layout>
    <style>
        body {
            background: #ffffff !important;
            margin: 0;
            height: 100vh;
            overflow: hidden; 
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .compact-auth-card {
            width: 100%;
            max-width: 650px;
            padding: 40px 60px; 
            background: #ffffff;
            border-radius: 35px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        }

        .brand-compact {
            font-size: 45px;
            font-weight: 900;
            color: #000;
            letter-spacing: -3px;
            text-align: center;
            margin-bottom: 35px;
        }

        .input-label-compact {
            font-size: 10px;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 8px;
            display: block;
            margin-left: 10px;
        }

        .input-wide-compact {
            width: 100% !important;
            padding: 18px 25px !important; 
            border-radius: 15px !important;
            background: #f8fafc !important;
            border: 2px solid #f1f5f9 !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            color: #1e293b !important;
            outline: none !important;
            transition: 0.3s ease;
        }

        .input-wide-compact:focus {
            background: white !important;
            border-color: #000000 !important;
        }

        .btn-compact {
            width: 100% !important;
            padding: 18px !important;
            border-radius: 15px !important;
            background: #000000 !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            text-transform: uppercase !important;
            letter-spacing: 3px !important;
            border: none !important;
            cursor: pointer;
            margin-top: 15px;
        }

        .forgot-bottom {
            display: block;
            text-align: right;
            margin-top: 8px;
            font-size: 12px;
            font-weight: 700;
            color: #cbd5e1;
            text-decoration: none;
            font-style: italic;
        }
        .forgot-bottom:hover { color: #000; }

        .remember-compact {
            margin-top: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 700;
        }
    </style>

    <div class="compact-auth-card">
        <div class="brand-compact">NEXUS</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom: 20px;">
                <label class="input-label-compact">Identifiant</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                    class="input-wide-compact" placeholder="votre@email.com">
            </div>

            <div style="margin-bottom: 20px;">
                <label class="input-label-compact">Mot de passe</label>
                <input id="password" type="password" name="password" required 
                    class="input-wide-compact" placeholder="••••••••••••">
                
                @if (Route::has('password.request'))
                    <a class="forgot-bottom" href="{{ route('password.request') }}">Oublié ?</a>
                @endif
            </div>

            <button type="submit" class="btn-compact">
                Se Connecter
            </button>

            <div class="remember-compact">
                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer;">
                    <input type="checkbox" name="remember" style="width: 16px; height: 16px; accent-color: #000;">
                    Rester connecté
                </label>
            </div>
        </form>
    </div>
</x-guest-layout>