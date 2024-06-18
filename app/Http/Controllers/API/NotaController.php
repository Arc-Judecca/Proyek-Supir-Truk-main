<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Nota;
use App\Models\Supir;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NotaController extends Controller
{
    public function showNota()
    {
        $nota = Nota::all();
        return view('nota.nota', compact('nota'));
    }

    public function uploadNota()
    {
        $supirs = Supir::all();
        return view('nota.book', compact('supirs'));
    }

    public function storeNota(Request $request)
    {
        $request->validate([
            'supir_id' => 'required',
            'tanggal' => 'required|date',
            'nota' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $notaPath = $request->file('nota')->store('notas', 'public');

        Nota::create([
            'supir_id' => $request->supir_id,
            'tanggal' => $request->tanggal,
            'nota' => $notaPath,
            'nota_path' => $notaPath,
        ]);

        return redirect()->route('supir.nota')->with('status_success', 'Nota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $nota = Nota::findOrFail($id);
        $supirs = Supir::all();
        return view('nota.alter', compact('nota', 'supirs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supir_id' => 'required',
            'tanggal' => 'required|date',
            'nota' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $nota = Nota::findOrFail($id);
        $notaPath = $nota->nota;

        if ($request->hasFile('nota')) {
            Storage::delete('public/' . $nota->nota);
            $notaPath = $request->file('nota')->store('notas', 'public');
        }

        $nota->update([
            'supir_id' => $request->supir_id,
            'tanggal' => $request->tanggal,
            'nota' => $notaPath,
            'nota_path' => $notaPath,
        ]);

        return redirect()->route('supir.nota')->with('status_success', 'Nota berhasil diupdate');
    }

    public function destroy($id)
    {
        $nota = Nota::findOrFail($id);
        Storage::delete('public/' . $nota->nota);
        $nota->delete();

        return redirect()->route('supir.nota')->with('status_success', 'Nota berhasil dihapus');
    }
}
