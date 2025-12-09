<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lembar Kerja Penilaian</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body class="bg-white">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #60a5fa, #3b82f6);">
        <div class="container-fluid">
            <span class="navbar-brand fw-bold d-flex align-items-center gap-2">
                <img src="{{ asset('images/dasboard.png') }}" alt="Logo" style="height:32px; object-fit: contain;">
                <span>Penilai</span>
            </span>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button type="submit" class="btn btn-light btn-sm">Keluar</button>
            </form>
        </div>
    </nav>

    <main class="container py-4">
        <div id="startCard" class="card shadow-sm mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Siap memulai wawancara?</h5>
                    <p class="mb-0 text-muted">Klik tombol di kanan untuk membuka lembar penilaian.</p>
                </div>
                <button id="btnMulai" class="btn btn-primary">Mulai Wawancara</button>
            </div>
        </div>

        <div id="penilaianSection" class="d-none">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="fw-bold text-primary mb-1">LEMBAR KERJA PENILAIAN WAWANCARA GURU SILN (YANGON)</h3>
                <p class="text-muted mb-4">Fokus: PJJ, Inovasi Pendidikan, &amp; Deep Learning</p>

                <form action="#" method="POST" onsubmit="return false;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Penilai (Pilih Tim)</label>
                            <select id="penilai" class="form-select">
                                <option value="">Pilih tim penilai</option>
                                @foreach ($pewawancaraGroups as $tim => $members)
                                    <option value="{{ $tim }}">
                                        {{ $tim }}: {{ $members->pluck('nama')->implode(', ') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Posisi Dilamar</label>
                            <input id="mapel" type="text" class="form-control" placeholder="" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Guru</label>
                            <select id="namaGuru" class="form-select">
                                <option value="">Pilih guru</option>
                                @foreach ($guruList as $guru)
                                    <option value="{{ $guru->id }}"
                                        data-instansi="{{ $guru->instansi }}"
                                        data-mapel="{{ $guru->mapel }}"
                                        data-tim="{{ $guru->tim }}">
                                        {{ $guru->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Instansi / Sekolah</label>
                            <input id="instansi" type="text" class="form-control" placeholder="" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-body">
                @include('pewawancara.instrumen')
                <div class="mt-3">
                    <div class="card shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold text-primary">Summary</h6>
                                <button id="btnSummary" type="button" class="btn btn-outline-primary btn-sm">Summary</button>
                            </div>
                            <div id="summaryContent" class="mt-3 small">
                                <p class="mb-1"><strong>Nama Calon Guru:</strong> <span id="summaryNamaGuru">-</span></p>
                                <div class="d-flex justify-content-between"><span>A. Profil &amp; Kepribadian (25%)</span><span id="summaryA">0.00</span></div>
                                <div class="d-flex justify-content-between"><span>B. Pedagogi PJJ (30%)</span><span id="summaryB">0.00</span></div>
                                <div class="d-flex justify-content-between"><span>C. Teknologi &amp; Desain (25%)</span><span id="summaryC">0.00</span></div>
                                <div class="d-flex justify-content-between"><span>D. Asesmen &amp; Sosial (20%)</span><span id="summaryD">0.00</span></div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between fw-bold"><span>Total</span><span id="summaryTotal">0.00</span></div>
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-2">Rekomendasi Pewawancara:</h6>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rekomendasi" id="rek1" value="Sangat Disarankan">
                        <label class="form-check-label" for="rek1">
                            SANGAT DISARANKAN (Rata-rata &gt; 4.5) - Top Talent / Guru Penggerak
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rekomendasi" id="rek2" value="Disarankan">
                        <label class="form-check-label" for="rek2">
                            DISARANKAN (Rata-rata 3.5 - 4.4) - Kompeten, butuh sedikit induksi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rekomendasi" id="rek3" value="Dipertimbangkan">
                        <label class="form-check-label" for="rek3">
                            DIPERTIMBANGKAN (Rata-rata 3.0 - 3.4) - Cukup, perlu pelatihan intensif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="rekomendasi" id="rek4" value="Tidak Disarankan">
                        <label class="form-check-label" for="rek4">
                            TIDAK DISARANKAN (Rata-rata &lt; 3.0) - Belum memenuhi standar PJJ
                        </label>
                    </div>

                    <div class="mt-3">
                        <label for="catatanKhusus" class="form-label">Catatan Khusus / Kekuatan &amp; Kelemahan Utama:</label>
                        <textarea id="catatanKhusus" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <div class="me-3 text-success small" id="saveMessage" style="display:none;"></div>
                        <button id="btnHitung" type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectGuru = document.getElementById('namaGuru');
            const instansiInput = document.getElementById('instansi');
            const mapelInput = document.getElementById('mapel');
            const btnHitung = document.getElementById('btnHitung');
            const btnSummary = document.getElementById('btnSummary');
            const btnMulai = document.getElementById('btnMulai');
            const startCard = document.getElementById('startCard');
            const section = document.getElementById('penilaianSection');
            const successModalEl = document.getElementById('successModal');
            const successModal = successModalEl ? new bootstrap.Modal(successModalEl) : null;
            const catatanInput = document.getElementById('catatanKhusus');
            const guruOptions = Array.from(document.querySelectorAll('#namaGuru option'))
                .map(opt => ({
                    value: opt.value,
                    text: opt.textContent,
                    instansi: opt.dataset.instansi,
                    mapel: opt.dataset.mapel,
                    tim: opt.dataset.tim || '',
                }));

            selectGuru?.addEventListener('change', (event) => {
                const option = event.target.selectedOptions[0];
                const instansi = option?.dataset.instansi || '';
                const mapel = option?.dataset.mapel || '';
                instansiInput.value = instansi;
                mapelInput.value = mapel;
            });

            btnMulai?.addEventListener('click', () => {
                startCard.classList.add('d-none');
                section.classList.remove('d-none');
            });

            const filterGuruByTim = (tim) => {
                const guruSelect = document.getElementById('namaGuru');
                const current = guruSelect.value;
                guruSelect.innerHTML = '';
                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = 'Pilih guru';
                guruSelect.appendChild(placeholder);

                guruOptions
                    .filter(opt => !tim || opt.tim === tim)
                    .forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt.value;
                        option.textContent = opt.text;
                        option.dataset.instansi = opt.instansi;
                        option.dataset.mapel = opt.mapel;
                        option.dataset.tim = opt.tim;
                        guruSelect.appendChild(option);
                    });

                if (!tim && current) {
                    guruSelect.value = current;
                }

                guruSelect.dispatchEvent(new Event('change'));
            };

            document.getElementById('penilai')?.addEventListener('change', (event) => {
                const tim = event.target.value;
                filterGuruByTim(tim);
            });

            const fillSummary = (kategoriA, kategoriB, kategoriC, kategoriD, total, namaGuru) => {
                document.getElementById('summaryNamaGuru').textContent = namaGuru;
                document.getElementById('summaryA').textContent = kategoriA.toFixed(2);
                document.getElementById('summaryB').textContent = kategoriB.toFixed(2);
                document.getElementById('summaryC').textContent = kategoriC.toFixed(2);
                document.getElementById('summaryD').textContent = kategoriD.toFixed(2);
                document.getElementById('summaryTotal').textContent = total.toFixed(2);

                document.getElementById('rekapNamaGuru').textContent = namaGuru;
                document.getElementById('rekapA').textContent = kategoriA.toFixed(2);
                document.getElementById('rekapB').textContent = kategoriB.toFixed(2);
                document.getElementById('rekapC').textContent = kategoriC.toFixed(2);
                document.getElementById('rekapD').textContent = kategoriD.toFixed(2);
                document.getElementById('rekapTotal').textContent = total.toFixed(2);
            };

            const setRecommendation = (avg) => {
                const radios = document.querySelectorAll('input[name="rekomendasi"]');
                radios.forEach(r => { r.checked = false; });

                let targetId = 'rek4';
                if (avg > 4.5) {
                    targetId = 'rek1';
                } else if (avg >= 3.5) {
                    targetId = 'rek2';
                } else if (avg >= 3.0) {
                    targetId = 'rek3';
                }

                const target = document.getElementById(targetId);
                if (target) target.checked = true;
            };

            const computeAndShow = (showModal = false) => {
                const getVal = (name) => {
                    const el = document.querySelector(`[name="${name}"]`);
                    return el ? Number.parseInt(el.value, 10) || 0 : 0;
                };

                const sum = (from, to) => {
                    let total = 0;
                    for (let i = from; i <= to; i++) {
                        total += getVal(`no${i}`);
                    }
                    return total;
                };

                const rawTotal = sum(1, 17);
                const avg = rawTotal / 17;

                const kategoriA = sum(1, 3) * 0.25;
                const kategoriB = sum(4, 10) * 0.30;
                const kategoriC = sum(11, 14) * 0.25;
                const kategoriD = sum(15, 17) * 0.20;
                const total = kategoriA + kategoriB + kategoriC + kategoriD;

                const namaGuru = selectGuru?.selectedOptions[0]?.textContent?.trim() || '-';
                const namaGuruId = selectGuru?.value || '';
                const penilaiSelect = document.getElementById('penilai');
                const penilaiTim = penilaiSelect?.value || null;
                const penilaiNama = penilaiSelect?.selectedOptions[0]?.textContent?.trim() || null;
                const catatan = catatanInput?.value || null;

                fillSummary(kategoriA, kategoriB, kategoriC, kategoriD, total, namaGuru);
                setRecommendation(avg);
                const rekomendasi = document.querySelector('input[name="rekomendasi"]:checked')?.value || null;

                if (showModal) {
                    const modalEl = document.getElementById('rekapModal');
                    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modal.show();
                }

                return {
                    namaGuru,
                    namaGuruId,
                    instansi: instansiInput.value,
                    posisi: mapelInput.value,
                    penilaiId: null,
                    penilaiTim,
                    penilaiNama,
                    kategoriA,
                    kategoriB,
                    kategoriC,
                    kategoriD,
                    total,
                    catatan,
                    rekomendasi,
                };
            };

            const savePenilaian = (payload) => {
                const msg = document.getElementById('saveMessage');
                msg.style.display = 'none';
                msg.textContent = '';

                fetch('{{ route('penilaian.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        user_guru_id: payload.namaGuruId,
                        instansi: payload.instansi,
                        posisi_dilamar: payload.posisi,
                        nilai_profile_dan_kepribadian: payload.kategoriA,
                        nilai_pedagogy: payload.kategoriB,
                        nilai_teknologi_dan_desain: payload.kategoriC,
                        nilai_asesmen_dan_sosial: payload.kategoriD,
                        total: payload.total,
                        catatan_khusus: payload.catatan,
                        rekomendasi: payload.rekomendasi,
                        penilai_id: payload.penilaiId,
                        penilai_nama: payload.penilaiNama,
                        penilai2: null,
                        penilai3: null,
                        penilai4: null,
                    }),
                })
                .then(async (response) => {
                    if (!response.ok) {
                        const err = await response.json().catch(() => ({}));
                        throw new Error(err.message || 'Gagal menyimpan.');
                    }
                    return response.json();
                })
                .then(() => {
                    msg.textContent = 'Hasil penilaian tersimpan.';
                    msg.style.display = 'block';
                    msg.classList.remove('text-danger');
                    msg.classList.add('text-success');
                    // Remove saved guru from available options
                    if (payload.namaGuruId) {
                        const index = guruOptions.findIndex(o => o.value === payload.namaGuruId);
                        if (index >= 0) {
                            guruOptions.splice(index, 1);
                        }
                        filterGuruByTim(document.getElementById('penilai')?.value || '');
                    }
                    if (successModal) {
                        successModal.show();
                    }
                })
                .catch((error) => {
                    msg.textContent = error.message;
                    msg.style.display = 'block';
                    msg.classList.remove('text-success');
                    msg.classList.add('text-danger');
                    alert(error.message);
                });
            };

            btnHitung?.addEventListener('click', () => {
                const result = computeAndShow(false);
                if (!result.namaGuruId || !result.penilaiTim) {
                    alert('Pilih Tim Penilai dan Nama Guru terlebih dahulu.');
                    return;
                }
                savePenilaian(result);
            });
            btnSummary?.addEventListener('click', () => computeAndShow(false));

            if (successModalEl) {
                successModalEl.addEventListener('hidden.bs.modal', () => {
                    section.classList.add('d-none');
                    startCard.classList.remove('d-none');
                    document.querySelector('form')?.reset();
                });
            }
        });
    </script>

    <div class="modal fade" id="rekapModal" tabindex="-1" aria-labelledby="rekapModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rekapModalLabel">Rekapitulasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2"><strong>Nama Calon Guru:</strong> <span id="rekapNamaGuru">-</span></p>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>A. Profil & Kepribadian (25%)</span>
                        <span id="rekapA">0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>B. Pedagogi PJJ (30%)</span>
                        <span id="rekapB">0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>C. Teknologi & Desain (25%)</span>
                        <span id="rekapC">0.00</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>D. Asesmen & Sosial (20%)</span>
                        <span id="rekapD">0.00</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total</span>
                        <span id="rekapTotal">0.00</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Berhasil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Data penilaian berhasil disimpan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
