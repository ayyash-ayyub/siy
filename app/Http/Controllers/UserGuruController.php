<?php

namespace App\Http\Controllers;

use App\Models\UserGuru;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserGuruController extends Controller
{
    /**
     * Show manage page with list and optional edit.
     */
    public function index(): View
    {
        $items = UserGuru::orderByDesc('created_at')->get();

        return view('calon_guru.manage', [
            'items' => $items,
            'editing' => null,
        ]);
    }

    /**
     * Store a new calon guru record.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);

        UserGuru::create($data);

        return redirect()->route('calon-guru.index')->with('status', 'Data calon guru berhasil ditambahkan.');
    }

    /**
     * Show manage page in edit mode.
     */
    public function edit(UserGuru $userGuru): View
    {
        $items = UserGuru::orderByDesc('created_at')->get();

        return view('calon_guru.manage', [
            'items' => $items,
            'editing' => $userGuru,
        ]);
    }

    /**
     * Update an existing calon guru record.
     */
    public function update(Request $request, UserGuru $userGuru): RedirectResponse
    {
        $data = $this->validatedData($request, $userGuru->id);

        $userGuru->update($data);

        return redirect()->route('calon-guru.index')->with('status', 'Data calon guru diperbarui.');
    }

    /**
     * Delete a calon guru record.
     */
    public function destroy(UserGuru $userGuru): RedirectResponse
    {
        $userGuru->delete();

        return redirect()->route('calon-guru.index')->with('status', 'Data calon guru dihapus.');
    }

    /**
     * Validation helper for create/update.
     */
    private function validatedData(Request $request, ?int $ignoreId = null): array
    {
        $uniqueNik = 'unique:user_guru,nik';
        $uniqueNip = 'unique:user_guru,nip';

        if ($ignoreId) {
            $uniqueNik .= ',' . $ignoreId;
            $uniqueNip .= ',' . $ignoreId;
        }

        return $request->validate([
            'nik' => ['required', 'integer', $uniqueNik],
            'nama' => ['required', 'string', 'max:255'],
            'mapel' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'integer', $uniqueNip],
            'pangkat' => ['required', 'string', 'max:255'],
            'instansi' => ['required', 'string', 'max:255'],
            'jenjang' => ['required', 'string', 'max:50'],
            'kabupaten' => ['required', 'string', 'max:255'],
            'provinsi' => ['required', 'string', 'max:255'],
            'tim' => ['required', 'in:Tim A,Tim B,Tim C,Tim D'],
        ]);
    }
}
