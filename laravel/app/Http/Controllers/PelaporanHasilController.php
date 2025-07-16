<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelaporanHasil; // ✅ PENTING
use Illuminate\Support\Facades\Storage;

class PelaporanHasilController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $laporans = PelaporanHasil::orderBy('tanggal_audit', 'desc')->get();
        return view('audit.pelaporan_hasil_audit', compact('laporans'));
    }

    // Simpan laporan baru (upload dari auditor atau auditee)
    public function store(Request $request)
    {
        $request->validate([
            'nama_auditee' => 'required|string',
            'unit' => 'required|string',
            'tanggal_audit' => 'required|date',
            'status' => 'required|string',
            'catatan' => 'nullable|string',
            'file' => 'nullable|file|max:10240', // maks 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pelaporan', 'public');
        }

        PelaporanHasil::create([
            'nama_auditee' => $request->nama_auditee,
            'unit' => $request->unit,
            'tanggal_audit' => $request->tanggal_audit,
            'status' => $request->status,
            'catatan' => $request->catatan,
            'file' => $filePath,
        ]);

        return redirect()->route('pelaporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    // Untuk update status/catatan
    public function update(Request $request, $id)
    {
        $laporan = PelaporanHasil::findOrFail($id);
        $laporan->update($request->only('status', 'catatan'));

        return redirect()->route('pelaporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    // Hapus laporan
    public function destroy($id)
    {
        $laporan = PelaporanHasil::findOrFail($id);
        if ($laporan->file) {
            Storage::disk('public')->delete($laporan->file);
        }
        $laporan->delete();

        return redirect()->route('pelaporan.index')->with('success', 'Laporan berhasil dihapus.');
}
}
