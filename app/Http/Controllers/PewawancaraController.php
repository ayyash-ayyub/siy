<?php

namespace App\Http\Controllers;

use App\Models\Pewawancara;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PewawancaraController extends Controller
{
    public function index(): View
    {
        return view('pewawancara.manage', [
            'items' => Pewawancara::orderByDesc('created_at')->get(),
            'editing' => null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        Pewawancara::create($data);

        return redirect()->route('pewawancara.index')->with('status', 'Data pewawancara ditambahkan.');
    }

    public function edit(Pewawancara $pewawancara): View
    {
        return view('pewawancara.manage', [
            'items' => Pewawancara::orderByDesc('created_at')->get(),
            'editing' => $pewawancara,
        ]);
    }

    public function update(Request $request, Pewawancara $pewawancara): RedirectResponse
    {
        $data = $this->validated($request);
        $pewawancara->update($data);

        return redirect()->route('pewawancara.index')->with('status', 'Data pewawancara diperbarui.');
    }

    public function destroy(Pewawancara $pewawancara): RedirectResponse
    {
        $pewawancara->delete();

        return redirect()->route('pewawancara.index')->with('status', 'Data pewawancara dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'instansi' => ['required', 'string', 'max:255'],
            'tim' => ['required', 'in:Tim A,Tim B,Tim C,Tim D'],
        ]);
    }
}
