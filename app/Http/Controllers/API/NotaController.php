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
        $nota = Nota::all(); // Pastikan nama model diawali huruf besar
        $supirs = Supir::all(); // Tambahkan ini untuk mendapatkan data supir
        return view('nota.nota', compact('nota', 'supirs')); // Kirim variabel 'supirs' ke view
    }

    public function uploadNota()
    {
        $nota = Nota::all(); // Pastikan nama model diawali huruf besar
        $supirs = Supir::all(); // Tambahkan ini untuk mendapatkan data supir
        return view('nota.book', compact('nota', 'supirs')); // Kirim variabel 'supirs' ke view
    }

    public function storeNota(Request $request)
    {
        // Validasi dan simpan data nota
        $request->validate([
            'supir_id' => 'required',
            'tanggal' => 'required|date',
            'nota' => 'required',
        ]);

        Nota::create([
            'supir_id' => $request->supir_id,
            'tanggal' => $request->tanggal,
            'nota' => $request->nota,
        ]);

        return redirect()->route('supir.nota')->with('status_success', 'Nota berhasil ditambahkan');
    }
}
