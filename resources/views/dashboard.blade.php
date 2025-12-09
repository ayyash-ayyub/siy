<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        :root {
            --primary: #60a5fa;
            --primary-dark: #3b82f6;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 10px 30px rgba(32, 93, 92, 0.35);
        }
        .brand {
            font-weight: 800;
            letter-spacing: 0.5px;
            font-size: 20px;
        }
        nav {
            display: flex;
            gap: 14px;
            align-items: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.14);
            transition: background 0.2s ease, transform 0.15s ease;
        }
        nav a:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-1px);
        }
        main {
            max-width: 1100px;
            margin: 28px auto;
            padding: 0 20px;
        }
        .panel {
            background: var(--card);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
        }
        h2 {
            margin: 0 0 8px;
            font-size: 24px;
        }
        p {
            margin: 0;
            color: var(--muted);
        }
        form.logout {
            margin: 0;
        }
        button.logout-btn {
            background: rgba(255,255,255,0.2);
            color: white;
            border: 1px solid rgba(255,255,255,0.3);
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
        }
        button.logout-btn:hover {
            background: rgba(255,255,255,0.22);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <header>
        <div class="brand d-flex align-items-center gap-2">
            <img src="{{ asset('images/dasboard.png') }}" alt="Logo" style="height:32px; object-fit: contain;">
            <span>Dashboard</span>
        </div>
        <nav aria-label="Menu">

            <a href="{{ route('calon-guru.index') }}">Tambah data calon guru</a>
            <a href="{{ route('pewawancara.index') }}">Data Pewawancara</a>
            <a href="{{ route('hasil-penilaian.index') }}">Hasil Penilaian</a>
            <form class="logout" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Keluar</button>
            </form>
        </nav>
    </header>

    <main>
        <section class="panel">
            <h2>Selamat datang, {{ auth()->user()->name }}!</h2>
            <p>Apps penilaian calon guru SILN v.10.</p>
        </section>
    </main>
</body>
</html>
