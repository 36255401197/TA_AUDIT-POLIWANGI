<?php

namespace App\Http\Controllers;

use App\Models\JadwalAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class JadwalAuditController extends Controller
{
   
    public function index()
{
    $jadwals = JadwalAudit::orderBy('tanggal_audit', 'asc')->get();

    if (Auth::user()->role === 'auditee' || Auth::user()->role === 'auditor') {
        return view('dashboard.jadwal.index_auditee', compact('jadwals'));
    } else {
        return view('dashboard.jadwal.index', compact('jadwals'));
    }
}

    public function store(Request $request)
    {
         if (!in_array(Auth::user()->role, ['lead_auditor'])) {
        abort(403, 'Unauthorized');
         }
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_audit'       => 'required|date',
            'auditor'       => 'required|string|max:255',
            'auditee'       => 'required|string|max:255',
            'waktu'         => 'required',
            'lokasi'        => 'required|string|max:255',
            'status'        => 'required|in:Belum,Berlangsung,Selesai',
        ]);

        JadwalAudit::create($validatedData);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
           if (!in_array(Auth::user()->role, ['lead_auditor', 'auditor'])) {
        abort(403, 'Unauthorized');
    }
        $validatedData = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_audit'       => 'required|date',
            'auditor'       => 'required|string|max:255',
            'auditee'       => 'required|string|max:255',
            'waktu'         => 'required',
            'lokasi'        => 'required|string|max:255',
            'status'        => 'required|in:Belum,Berlangsung,Selesai',
        ]);

        $jadwal = JadwalAudit::findOrFail($id);
        $jadwal->update($validatedData);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
           if (!in_array(Auth::user()->role, ['lead_auditor', 'auditor'])) {
        abort(403, 'Unauthorized');
    }
        $jadwal = JadwalAudit::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}