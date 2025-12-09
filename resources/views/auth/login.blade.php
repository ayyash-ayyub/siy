<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        :root {
            --primary: #1e2be3;
            --primary-dark: #0a5de4;
            --background: #f1f5f9;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            background: radial-gradient(circle at top left, #e0f2fe, #f8fafc 60%);
            color: var(--text);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .card {
            width: 100%;
            max-width: 420px;
            background: var(--card);
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 20px 70px rgba(15, 23, 42, 0.12);
            border: 1px solid #e2e8f0;
        }
        h1 {
            margin: 0 0 8px;
            font-size: 28px;
            letter-spacing: -0.5px;
        }
        p {
            margin: 0 0 24px;
            color: var(--muted);
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            font-size: 15px;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(43, 122, 120, 0.15);
        }
        button {
            width: 100%;
            padding: 12px 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            font-weight: 700;
            letter-spacing: 0.3px;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.2s ease;
        }
        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(32, 93, 92, 0.25);
        }
        .error {
            background: #f2f3fe;
            border: 1px solid #fecdd3;
            color: #b91c1c;
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 12px;
            font-size: 14px;
        }
        .helper {
            margin-top: 10px;
            font-size: 13px;
            color: var(--muted);
        }
    </style>
</head>
<body>
    <main class="card" aria-label="Halaman login">
        <div class="text-center mb-3">
            <img src="{{ asset('images/logo-gtk.jpeg') }}" alt="Logo" style="height:52px; object-fit: contain;">
        </div>
        <br>
        <p>Apps Wawancara Guru SILN (YANGON)</p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="{{ old('username') }}" autocomplete="username" required>

            <label for="password" style="margin-top:16px;">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>

            <button type="submit" style="margin-top:20px;">Masuk</button>
        </form>


    </main>
</body>
</html>
