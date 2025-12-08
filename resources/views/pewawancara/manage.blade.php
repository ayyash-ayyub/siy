<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pewawancara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #60a5fa, #3b82f6);">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Dashboard</a>
            <div class="d-flex align-items-center gap-2">
                <a class="btn btn-outline-light btn-sm" href="{{ route('calon-guru.index') }}">Calon Guru</a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('pewawancara.index') }}">Pewawancara</a>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="row g-4">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mb-3" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">{{ $editing ? 'Edit pewawancara' : 'Tambah pewawancara' }}</h5>
                            <small class="text-muted">Isi nama dan instansi pewawancara.</small>
                        </div>
                        @if ($editing)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('pewawancara.index') }}">Batal edit</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ $editing ? route('pewawancara.update', $editing) : route('pewawancara.store') }}">
                            @csrf
                            @if ($editing)
                                @method('PUT')
                            @endif
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $editing?->nama) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Instansi</label>
                                    <input type="text" name="instansi" class="form-control" value="{{ old('instansi', $editing?->instansi) }}" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ $editing ? 'Perbarui' : 'Simpan' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0">Data Pewawancara</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Instansi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        <tr @if($editing && $editing->id === $item->id) class="table-warning" @endif>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->instansi }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('pewawancara.edit', $item) }}" class="text-primary me-2" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('pewawancara.destroy', $item) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline" onclick="return confirm('Hapus data ini?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-4">Belum ada data pewawancara.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
