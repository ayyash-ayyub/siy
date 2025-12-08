<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Calon Guru</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #60a5fa, #3b82f6);">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:32px;">
                <span>Dashboard</span>
            </a>
            <div class="d-flex align-items-center gap-2">
                <a class="btn btn-outline-light btn-sm" href="{{ route('calon-guru.index') }}">Manage calon guru</a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('pewawancara.index') }}">Data Pewawancara</a>
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
                            <h5 class="mb-0">{{ $editing ? 'Edit data calon guru' : 'Tambah data calon guru' }}</h5>
                            <small class="text-muted">Lengkapi semua kolom untuk menyimpan data.</small>
                        </div>
                        @if ($editing)
                            <a class="btn btn-outline-secondary btn-sm" href="{{ route('calon-guru.index') }}">Batal edit</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ $editing ? route('calon-guru.update', $editing) : route('calon-guru.store') }}">
                            @csrf
                            @if ($editing)
                                @method('PUT')
                            @endif
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <input type="number" name="nik" class="form-control" value="{{ old('nik', $editing?->nik) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">NIP</label>
                                    <input type="number" name="nip" class="form-control" value="{{ old('nip', $editing?->nip) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $editing?->nama) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Mapel</label>
                                    <select name="mapel" class="form-select" required>
                                        <option value="">Pilih mapel</option>
                                        @php
                                            $mapelOptions = [
                                                'Bahasa Inggris',
                                                'IPA',
                                                'IPA dan Guru Pendamping Khusus Tingkat lanjut',
                                                'IPA Terpadu',
                                                'IPS',
                                            ];
                                        @endphp
                                        @foreach ($mapelOptions as $mapel)
                                            <option value="{{ $mapel }}" @selected(old('mapel', $editing?->mapel) === $mapel)>{{ $mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Pangkat</label>
                                    <input type="text" name="pangkat" class="form-control" value="{{ old('pangkat', $editing?->pangkat) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Instansi</label>
                                    <input type="text" name="instansi" class="form-control" value="{{ old('instansi', $editing?->instansi) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tim</label>
                                    <select name="tim" class="form-select" required>
                                        <option value="">Pilih tim</option>
                                        @php $timOptions = ['Tim A', 'Tim B', 'Tim C', 'Tim D']; @endphp
                                        @foreach ($timOptions as $tim)
                                            <option value="{{ $tim }}" @selected(old('tim', $editing?->tim) === $tim)>{{ $tim }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jenjang</label>
                                    <select name="jenjang" class="form-select" required>
                                        <option value="">Pilih jenjang</option>
                                        @php
                                            $jenjangOptions = ['SD', 'SMP', 'SMA', 'SMK', 'Lainnya'];
                                        @endphp
                                        @foreach ($jenjangOptions as $jenjang)
                                            <option value="{{ $jenjang }}" @selected(old('jenjang', $editing?->jenjang) === $jenjang)>{{ $jenjang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kabupaten</label>
                                    <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $editing?->kabupaten) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Provinsi</label>
                                    <input type="text" name="provinsi" class="form-control" value="{{ old('provinsi', $editing?->provinsi) }}" required>
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
                        <h5 class="mb-0">Data calon guru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Mapel</th>
                                        <th>NIP</th>
                                        <th>Pangkat</th>
                                        <th>Instansi</th>
                                        <th>Jenjang</th>
                                        <th>Kabupaten</th>
                                        <th>Provinsi</th>
                                        <th>Tim</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        <tr @if($editing && $editing->id === $item->id) class="table-warning" @endif>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->mapel }}</td>
                                            <td>{{ $item->nip }}</td>
                                            <td>{{ $item->pangkat }}</td>
                                        <td>{{ $item->instansi }}</td>
                                        <td>{{ $item->jenjang }}</td>
                                        <td>{{ $item->kabupaten }}</td>
                                        <td>{{ $item->provinsi }}</td>
                                        <td>{{ $item->tim }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('calon-guru.edit', $item) }}" class="text-primary me-2" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                                <form action="{{ route('calon-guru.destroy', $item) }}" method="POST" class="d-inline">
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
                                            <td colspan="10" class="text-center text-muted py-4">Belum ada data calon guru.</td>
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
