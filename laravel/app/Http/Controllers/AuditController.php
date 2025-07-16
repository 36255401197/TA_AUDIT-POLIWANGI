<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    // Menampilkan daftar audit di dashboard
    public function index()
    {
        $audits = Audit::all();
        return view('dashboard.dashboard', compact('audits'));
    }

    // Menyimpan data audit baru dari form tambah
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'status' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        Audit::create($validated);

        return redirect()->route('dashboard')->with('success', 'Audit berhasil ditambahkan');
    }

    // Menampilkan data audit berdasarkan ID untuk edit (via AJAX)
    public function show($id)
    {
        $audit = Audit::findOrFail($id);
        return response()->json($audit);
    }

    // Mengupdate data audit yang sudah ada
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'status' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $audit = Audit::findOrFail($id);
        $audit->update($validated);

        return redirect()->route('dashboard')->with('success', 'Audit berhasil diperbarui');
    }

    // Menghapus data audit
    public function destroy($id)
    {
        $audit = Audit::findOrFail($id);
        $audit->delete();

        return redirect()->route('dashboard')->with('success', 'Audit berhasil dihapus');
    }
}
