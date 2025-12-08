<style>
    .instrumen-table table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
    }

    .instrumen-table th,
    .instrumen-table td {
        border: 1px solid #d0d7de;
        padding: 10px;
        vertical-align: top;
    }

    .instrumen-table th {
        background: #eef2ff;
        font-weight: 700;
        text-align: center;
    }

    .instrumen-table .section-title {
        font-weight: 700;
        font-size: 15px;
        margin-top: 18px;
        margin-bottom: 10px;
    }

    .instrumen-table .no-col {
        width: 35px;
        text-align: center;
    }

    .instrumen-table .score-col {
        width: 90px;
        text-align: center;
    }

    .instrumen-table .catatan-col {
        width: 180px;
    }

    .instrumen-table textarea {
        width: 100%;
        min-height: 100%;
        height: 100%;
        resize: vertical;
    }

    /* Hide Catatan Bukti (STAR Method) column */
    .instrumen-table th.catatan-col,
    .instrumen-table td:last-child {
        display: none;
    }
</style>

@php
    $scoreOptions = [1, 2, 3, 4, 5];
@endphp

<div class="instrumen-table">
    <h5 class="fw-bold text-primary mb-2 text-center">TABEL PENILAIAN KOMPETENSI</h5>
    <p class="text-muted mb-3"><strong>Petunjuk:</strong> Berikan skor 1 sampai 5 pada kolom skor sesuai indikator penilaian. Penilai diperbolehkan memberikan skor 2 dan 4.</p>

    <!-- ======================= BAGIAN A ======================= -->
    <div class="section-title">A. PROFIL & KEPRIBADIAN</div>

    <table>
        <tr>
            <th class="no-col">NO</th>
            <th>Dimensi & Kompetensi</th>
            <th>Pertanyaan Kunci (Wawancara)</th>
            <th>Indikator Penilaian</th>
            <th class="score-col">Skor (1-5)</th>
            <th class="catatan-col">Catatan Bukti (STAR Method)</th>
        </tr>

        <tr>
            <td class="no-col">1</td>
            <td>Motivasi & Misi</td>
            <td>Apa motivasi terdalam Anda melamar di SILN Yangon khususnya untuk program PJJ? Apa bedanya mengajar di sini dengan sekolah biasa?</td>
            <td>
                Skor 1: Motivasi hanya finansial/tidak paham konteks SILN.<br><br>
                Skor 3: Motivasi standar; profil cukup relevan.<br><br>
                Skor 5: Motivasi visioner; ingin berkontribusi pada pendidikan diaspora.
            </td>
            <td>
                <select name="no1" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no1" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">2</td>
            <td>Resiliensi & Adaptasi</td>
            <td>Ceritakan pengalaman terberat/kegagalan Anda dan bagaimana Anda bangkit? Bagaimana Anda beradaptasi dengan budaya baru?</td>
            <td>
                Skor 1: Mudah menyerah; menyalahkan keadaan/orang lain.<br><br>
                Skor 3: Bertahan dengan solusi standar.<br><br>
                Skor 5: Growth mindset, menjadikan tantangan sebagai peluang belajar.
            </td>
            <td>
                <select name="no2" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no2" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">3</td>
            <td>Integritas & Kebangsaan</td>
            <td>Bagaimana Anda menanamkan identitas kebangsaan pada siswa lewat mapel Anda? Bagaimana menjaga integritas saat mengajar tanpa pengawasan fisik?</td>
            <td>
                Skor 1: Tidak peduli, hanya fokus akademik.<br><br>
                Skor 3: Memberikan nasihat umum namun tidak terintegrasi.<br><br>
                Skor 5: Proaktif menanamkan nilai kebangsaan secara kreatif.
            </td>
            <td>
                <select name="no3" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no3" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>
    </table>

    <!-- ======================= BAGIAN B ======================= -->
    <div class="section-title">B. PEDAGOGI PJJ (DEEP LEARNING)</div>

    <table>
        <tr>
            <th class="no-col">NO</th>
            <th>Dimensi & Kompetensi</th>
            <th>Pertanyaan Kunci</th>
            <th>Indikator Penilaian</th>
            <th class="score-col">Skor</th>
            <th class="catatan-col">Catatan</th>
        </tr>

        <tr>
            <td class="no-col">4</td>
            <td>Penyusunan Materi Asynchronous</td>
            <td>
                a. Format materi apa yang Anda gunakan?<br>
                b. Bagaimana memastikan materi mudah dipahami?
            </td>
            <td>
                Skor 1: Materi minim.<br><br>
                Skor 3: Variatif.<br><br>
                Skor 5: Berkualitas, interaktif, mengikuti prinsip multimedia learning.
            </td>
            <td>
                <select name="no4" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no4" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">5</td>
            <td>Perencanaan Sesi Synchronous</td>
            <td>
                Bagaimana Anda merencanakan sesi live?<br>
                Bagaimana menentukan tujuan dan alur?<br>
                Persiapan sebelum kelas?
            </td>
            <td>
                Skor 1: Hanya bisa join meeting.<br><br>
                Skor 3: Menggunakan fitur tambahan.<br><br>
                Skor 5: Mengoptimalkan fitur lanjutan secara kreatif.
            </td>
            <td>
                <select name="no5" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no5" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">6</td>
            <td>Mengelola Interaksi & Partisipasi</td>
            <td>
                Bagaimana mendorong siswa aktif?<br>
                Bagaimana memastikan semua terlibat?<br>
                Mengatasi siswa pasif?
            </td>
            <td>
                Skor 1: Tidak ada interaksi.<br><br>
                Skor 3: Tanya jawab dasar.<br><br>
                Skor 5: Interaksi efektif; diferensiasi & monitoring individu.
            </td>
            <td>
                <select name="no6" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no6" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">7</td>
            <td>Manajemen Kelas Multi-grade</td>
            <td>Bagaimana strategi membagi perhatian dan materi?</td>
            <td>
                Skor 1: Bingung mengelola kelas majemuk.<br><br>
                Skor 3: Mengajar bergantian.<br><br>
                Skor 5: Pembelajaran berdiferensiasi dengan manajemen waktu efektif.
            </td>
            <td>
                <select name="no7" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no7" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">8</td>
            <td>Joyful Learning</td>
            <td>Strategi konkret membuat kelas anti-bosan & reclaim fokus siswa?</td>
            <td>
                Skor 1: Ceramah panjang.<br><br>
                Skor 3: Kuis sesekali.<br><br>
                Skor 5: Gamification, humor, variasi interaksi.
            </td>
            <td>
                <select name="no8" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no8" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">9</td>
            <td>Meaningful Learning</td>
            <td>Bagaimana membuat materi relevan dengan konteks siswa Yangon?</td>
            <td>
                Skor 1: Hanya textbook.<br><br>
                Skor 3: Ada usaha mengaitkan contoh.<br><br>
                Skor 5: PBL relevan dengan konteks lokal & global.
            </td>
            <td>
                <select name="no9" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no9" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td class="no-col">10</td>
            <td>Mindful Learning & Soft Skill</td>
            <td>Strategi melatih 4C dan mindfulness?</td>
            <td>
                Skor 1: Fokus kognitif saja.<br><br>
                Skor 3: Melatih soft skill sesekali.<br><br>
                Skor 5: Terstruktur lewat breakout room & refleksi diri.
            </td>
            <td>
                <select name="no10" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no10" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>
    </table>

    <!-- ======================= BAGIAN C ======================= -->
    <div class="section-title">C. TEKNOLOGI & DESAIN (HARD SKILL)</div>

    <table>
        <tr>
            <th class="no-col">NO</th>
            <th>Dimensi & Kompetensi</th>
            <th>Pertanyaan Kunci</th>
            <th>Indikator Penilaian</th>
            <th class="score-col">Skor</th>
            <th class="catatan-col">Catatan</th>
        </tr>

        <tr>
            <td>11</td>
            <td>Penguasaan LMS</td>
            <td>Platform apa yang dikuasai? Bagaimana menyusun learning path?</td>
            <td>
                Skor 1: Gagap teknologi.<br><br>
                Skor 3: Bisa LMS dasar.<br><br>
                Skor 5: Mahir integrasi LMS + tools lain.
            </td>
            <td>
                <select name="no11" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no11" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td>12</td>
            <td>Desain Konten Multimedia</td>
            <td>Jelaskan alur membuat slide/video ajar.</td>
            <td>
                Skor 1: Slide penuh teks.<br><br>
                Skor 3: Visual rapi.<br><br>
                Skor 5: Estetis, multimedia balance, micro-learning.
            </td>
            <td>
                <select name="no12" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no12" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td>13</td>
            <td>Etika Digital & Keamanan Data</td>
            <td>Langkah menjaga privasi & keamanan data siswa?</td>
            <td>
                Skor 1: Tidak sadar risiko.<br><br>
                Skor 3: Paham dasar etika.<br><br>
                Skor 5: Cyber hygiene sangat kuat; edukasi netiquette.
            </td>
            <td>
                <select name="no13" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no13" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td>14</td>
            <td>Penguasaan Teknologi Video Conference</td>
            <td>Pengalaman memfasilitasi pembelajaran via VC?</td>
            <td>
                Skor 1: Hanya join meeting.<br><br>
                Skor 3: Gunakan fitur tambahan.<br><br>
                Skor 5: Mengoptimalkan fitur lanjutan secara mandiri.
            </td>
            <td>
                <select name="no14" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no14" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>
    </table>

    <!-- ======================= BAGIAN D ======================= -->
    <div class="section-title">D. ASESMEN & SOSIAL</div>

    <table>
        <tr>
            <th class="no-col">NO</th>
            <th>Dimensi & Kompetensi</th>
            <th>Pertanyaan</th>
            <th>Indikator Penilaian</th>
            <th class="score-col">Skor</th>
            <th class="catatan-col">Catatan</th>
        </tr>

        <tr>
            <td>15</td>
            <td>Monitoring Aktivitas & Kemajuan</td>
            <td>Bagaimana memantau aktivitas siswa dan membantu yang tertinggal?</td>
            <td>
                Skor 1: Tidak monitoring.<br><br>
                Skor 3: Monitoring dasar.<br><br>
                Skor 5: Monitoring proaktif & dukungan individual.
            </td>
            <td>
                <select name="no15" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no15" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td>16</td>
            <td>Asesmen Komprehensif</td>
            <td>Metode asesmen non-pilihan ganda? Cara mencegah kecurangan?</td>
            <td>
                Skor 1: Hanya ujian tulis.<br><br>
                Skor 3: Ada variasi soal.<br><br>
                Skor 5: Autentik (proyek/portofolio/vlog), self-assessment, feedback personal.
            </td>
            <td>
                <select name="no16" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no16" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>

        <tr>
            <td>17</td>
            <td>Komunikasi & Kolaborasi</td>
            <td>Bagaimana membangun komunikasi hangat dan kolaborasi tim?</td>
            <td>
                Skor 1: Komunikasi pasif/kaku.<br><br>
                Skor 3: Cukup jelas dan bisa bekerja dalam tim.<br><br>
                Skor 5: Sangat empatik, kolaboratif, dan solutif.
            </td>
            <td>
                <select name="no17" class="form-select form-select-sm">
                    @foreach ($scoreOptions as $opt)
                        <option value="{{ $opt }}" @selected($opt == 1)>{{ $opt }}</option>
                    @endforeach
                </select>
            </td>
            <td><textarea name="catatan_no17" class="form-control form-control-sm" rows="2"></textarea></td>
        </tr>
    </table>
</div>
