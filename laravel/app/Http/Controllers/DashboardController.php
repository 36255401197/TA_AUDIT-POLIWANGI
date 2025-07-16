<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\JadwalAudit;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // DASHBOARD UTAMA UNTUK LEAD AUDITOR
    public function index()
    {
        $audits = Audit::all();
        return view('dashboard.index', compact('audits'));
    }

    // CRUD Audit (hanya untuk Lead Auditor)
    public function store(Request $request)
    {
        // Optional: batasi hanya untuk Lead Auditor
        if (Auth::user()->role !== 'Lead Auditor') {
            abort(403, 'Anda tidak memiliki izin.');
        }

        $request->validate([
            'auditee' => 'required',
            'status' => 'required',
            'jenis_audit' => 'required',
            'tanggal' => 'required|date',
        ]);

        Audit::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Audit berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'Lead Auditor') {
            abort(403, 'Anda tidak memiliki izin.');
        }

        $audit = Audit::findOrFail($id);
        $audit->update($request->all());
        return redirect()->route('dashboard')->with('success', 'Audit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'Lead Auditor') {
            abort(403, 'Anda tidak memiliki izin.');
        }

        Audit::destroy($id);
        return redirect()->route('dashboard')->with('success', 'Audit berhasil dihapus.');
    }

    // PELAPORAN
    public function pelaporan()
    {
        $laporans = \App\Models\PelaporanHasil::all(); // Ambil semua data pelaporan
    return view('audit.pelaporan_hasil_audit', compact('laporans'));
    }

    // DASHBOARD AUDITOR (hanya melihat)
    public function auditor()
    {
        $jadwalAudit = JadwalAudit::orderBy('tanggal', 'asc')->get();
        $audits = Audit::orderBy('tanggal', 'desc')->take(5)->get();

        return view('dashboard.auditor', compact('jadwalAudit', 'audits'));
    }

    // DASHBOARD AUDITEE (hanya melihat jadwal)
    public function auditee()
    {
        $jadwalAudit = JadwalAudit::orderBy('tanggal', 'asc')->get();
        return view('dashboard.auditee', compact('jadwalAudit'));
    }
}
