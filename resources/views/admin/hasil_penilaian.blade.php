<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #60a5fa, #3b82f6);">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/dasboard.png') }}" alt="Logo" style="height:32px; object-fit: contain;">
                <span>Dashboard</span>
            </a>
            <div class="d-flex align-items-center gap-2">
                <a class="btn btn-outline-light btn-sm" href="{{ route('calon-guru.index') }}">Calon Guru</a>
                <a class="btn btn-outline-light btn-sm" href="{{ route('pewawancara.index') }}">Pewawancara</a>
                <a class="btn btn-light btn-sm" href="{{ route('hasil-penilaian.index') }}">Hasil Penilaian</a>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Keluar</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-md-between gap-2">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Hasil Penilaian</h5>
                    <a href="{{ route('hasil-penilaian.export') }}" class="btn btn-outline-primary btn-sm">Download CSV</a>
                </div>
                <div class="w-100 w-md-50">
                    <input id="searchGuru" type="text" class="form-control form-control-sm" placeholder="Cari Nama Guru">
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Guru</th>
                                <th>Instansi</th>
                                <th>Posisi</th>
                                <th>Profil &amp; Kepribadian</th>
                                <th>Pedagogi</th>
                                <th>Teknologi &amp; Desain</th>
                                <th>Asesmen &amp; Sosial</th>
                                <th>Total</th>
                                <th>Catatan</th>
                                <th>Tim Penilai</th>
                                <th>Status</th>
                                <th>Waktu</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td>{{ $item->userGuru->nama ?? '-' }}</td>
                                    <td>{{ $item->instansi }}</td>
                                    <td>{{ $item->posisi_dilamar }}</td>
                                    <td>{{ number_format($item->nilai_profile_dan_kepribadian, 2) }}</td>
                                    <td>{{ number_format($item->nilai_pedagogy, 2) }}</td>
                                    <td>{{ number_format($item->nilai_teknologi_dan_desain, 2) }}</td>
                                    <td>{{ number_format($item->nilai_asesmen_dan_sosial, 2) }}</td>
                                    <td class="fw-bold">{{ number_format($item->total, 2) }}</td>
                                    <td style="max-width:220px;">{{ $item->catatan_khusus ?? '-' }}</td>
                                    <td>{{ $item->namapenilai1 }}</td>
                                    <td>{{ $item->statusnilai ? '1 (Sudah dinilai)' : '0 (Belum dinilai)' }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('hasil-penilaian.destroy', $item) }}" method="POST" onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0 m-0 align-baseline">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('hasil-penilaian.reset', $item) }}" method="POST" class="d-inline" onsubmit="return confirmReset(event)">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-warning p-0 m-0 align-baseline">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center text-muted py-4">Belum ada hasil penilaian.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.js" defer></script>
    <script>
        function confirmDelete(event) {
            const input = prompt('Ketik hapusdataini untuk menghapus data:');
            if (input !== 'hapusdataini') {
                event.preventDefault();
                alert('Input tidak sesuai. Data tidak dihapus.');
                return false;
            }
            return true;
        }

        function confirmReset(event) {
            const input = confirm('Status nilai akan direset ke 0 dan guru harus dinilai kembali. Lanjutkan?');
            if (!input) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const search = document.getElementById('searchGuru');
            const rows = Array.from(document.querySelectorAll('table tbody tr'));

            search?.addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                rows.forEach(row => {
                    const nama = row.querySelector('td')?.textContent.toLowerCase() || '';
                    row.style.display = nama.includes(term) ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html>
