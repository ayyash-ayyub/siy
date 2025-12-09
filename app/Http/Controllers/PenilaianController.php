<?php

namespace App\Http\Controllers;

use App\Models\HasilPenilaian;
use App\Models\Pewawancara;
use App\Models\UserGuru;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PenilaianController extends Controller
{
    /**
     * Store hasil penilaian (penilai role).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_guru_id' => ['required', 'exists:user_guru,id'],
            'instansi' => ['required', 'string'],
            'posisi_dilamar' => ['required', 'string'],
            'nilai_profile_dan_kepribadian' => ['required', 'numeric'],
            'nilai_pedagogy' => ['required', 'numeric'],
            'nilai_teknologi_dan_desain' => ['required', 'numeric'],
            'nilai_asesmen_dan_sosial' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
            'catatan_khusus' => ['nullable', 'string'],
            'rekomendasi' => ['required', 'string'],
            'penilai_id' => ['nullable', 'exists:pewawancara,id'],
            'penilai_nama' => ['nullable', 'string'],
            'penilai2' => ['nullable', 'string'],
            'penilai3' => ['nullable', 'string'],
            'penilai4' => ['nullable', 'string'],
        ]);

        if (HasilPenilaian::where('user_guru_id', $validated['user_guru_id'])->exists()) {
            return response()->json([
                'message' => 'Data penilaian untuk guru ini sudah tersimpan sebelumnya.',
            ], Response::HTTP_CONFLICT);
        }

        $penilaiNama = null;
        if (!empty($validated['penilai_id'])) {
            $penilaiNama = Pewawancara::find($validated['penilai_id'])?->nama;
        }
        $penilaiNama = $penilaiNama ?: ($validated['penilai_nama'] ?? 'Penilai');

        $hasil = HasilPenilaian::create([
            'user_guru_id' => $validated['user_guru_id'],
            'instansi' => $validated['instansi'],
            'posisi_dilamar' => $validated['posisi_dilamar'],
            'nilai_profile_dan_kepribadian' => $validated['nilai_profile_dan_kepribadian'],
            'nilai_pedagogy' => $validated['nilai_pedagogy'],
            'nilai_teknologi_dan_desain' => $validated['nilai_teknologi_dan_desain'],
            'nilai_asesmen_dan_sosial' => $validated['nilai_asesmen_dan_sosial'],
            'total' => $validated['total'],
            'catatan_khusus' => $validated['catatan_khusus'] ?? null,
            'rekomendasi' => $validated['rekomendasi'],
            'statusnilai' => 1,
            'namapenilai1' => $penilaiNama,
            'namapenilai2' => $validated['penilai2'] ?? null,
            'namapenilai3' => $validated['penilai3'] ?? null,
            'namapenilai4' => $validated['penilai4'] ?? null,
        ]);

        return response()->json([
            'message' => 'Hasil penilaian tersimpan.',
            'data' => $hasil,
        ], Response::HTTP_CREATED);
    }

    /**
     * List hasil penilaian (admin).
     */
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $items = HasilPenilaian::with('userGuru')->latest()->get();

        return view('admin.hasil_penilaian', compact('items'));
    }

    /**
     * Export hasil penilaian as CSV (admin).
     */
    public function export(): StreamedResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $rows = HasilPenilaian::with('userGuru')->latest()->get();

        $columns = [
            'nama_guru',
            'nik',
            'nip',
            'mapel',
            'pangkat',
            'instansi',
            'jenjang',
            'kabupaten',
            'provinsi',
            'posisi_dilamar',
            'nilai_profile_dan_kepribadian',
            'nilai_pedagogy',
            'nilai_teknologi_dan_desain',
            'nilai_asesmen_dan_sosial',
            'total',
            'catatan_khusus',
            'statusnilai',
            'rekomendasi',
            'namapenilai1',
            'namapenilai2',
            'namapenilai3',
            'namapenilai4',
            'created_at',
        ];

        $callback = function () use ($rows, $columns) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $columns);

            foreach ($rows as $row) {
                $guru = $row->userGuru;
                fputcsv($handle, [
                    $guru->nama ?? '',
                    $guru->nik ?? '',
                    $guru->nip ?? '',
                    $guru->mapel ?? '',
                    $guru->pangkat ?? '',
                    $guru->instansi ?? '',
                    $guru->jenjang ?? '',
                    $guru->kabupaten ?? '',
                    $guru->provinsi ?? '',
                    $row->posisi_dilamar,
                    $row->nilai_profile_dan_kepribadian,
                    $row->nilai_pedagogy,
                    $row->nilai_teknologi_dan_desain,
                    $row->nilai_asesmen_dan_sosial,
                    $row->total,
                    $row->catatan_khusus,
                    $row->statusnilai,
                    $row->rekomendasi,
                    $row->namapenilai1,
                    $row->namapenilai2,
                    $row->namapenilai3,
                    $row->namapenilai4,
                    $row->created_at,
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, 'hasil_penilaian.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }

    /**
     * Delete a saved hasil penilaian (admin).
     */
    public function destroy(HasilPenilaian $hasilPenilaian)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $hasilPenilaian->delete();

        return redirect()->route('hasil-penilaian.index')->with('status', 'Hasil penilaian dihapus.');
    }

    /**
     * Reset statusnilai to 0 (admin).
     */
    public function resetStatus(HasilPenilaian $hasilPenilaian)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $hasilPenilaian->update(['statusnilai' => 0]);

        return redirect()->route('hasil-penilaian.index')->with('status', 'Status penilaian direset ke 0.');
    }
}
