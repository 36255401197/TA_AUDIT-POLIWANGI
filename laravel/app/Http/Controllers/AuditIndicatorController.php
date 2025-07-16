<?php

namespace App\Http\Controllers;

use App\Models\AuditIndicator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuditIndicatorController extends Controller
{
    public function index()
    {
        $indikatorList = AuditIndicator::all();

         if (Auth::user()->role === 'auditee' || Auth::user()->role === 'auditor') {
        return view('audit.pra_audit.index_auditor', compact('indikatorList'));
        } else {  
        return view('audit.pra_audit.index', compact('indikatorList'));
        }
    }

    public function auditeeView()
    {
        $indikatorList = AuditIndicator::all();
         
        return view('audit.pra_audit.auditee', compact('indikatorList'));
    }
    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['lead_auditor'])) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'kategori'   => 'required|string|max:255',
            'indikator'  => 'required|string|max:500',
            'kode'       => 'required|string|max:50',
        ]);

        AuditIndicator::create([
            'kategori'  => $request->kategori,
            'indikator' => $request->indikator,
            'kode'      => $request->kode,
            'checklist' => $request->has('checklist') ? 1 : 0,
        ]);

        return back()->with('success', 'Indikator berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        if (!in_array(Auth::user()->role, ['lead_auditor', 'auditor'])) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'kategori'   => 'required|string|max:255',
            'indikator'  => 'required|string|max:500',
            'kode'       => 'required|string|max:50',
        ]);

        $indikator = AuditIndicator::findOrFail($id);
        $indikator->update([
            'kategori'  => $request->kategori,
            'indikator' => $request->indikator,
            'kode'      => $request->kode,
            'checklist' => $request->has('checklist') ? 1 : 0,
            
        ]);

        return back()->with('success', 'Indikator berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (!in_array(Auth::user()->role, ['lead_auditor', 'auditor'])) {
            abort(403, 'Unauthorized');
        }

        $indikator = AuditIndicator::findOrFail($id);
        $indikator->delete();

        return back()->with('success', 'Indikator berhasil dihapus');
    }

    // public function uploadDokumen(Request $request, $id)
    // {
    //     if (Auth::user()->role !== 'auditee') {
    //         abort(403, 'Unauthorized');
    //     }

    //     $request->validate([
    //         'dokumen' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
    //     ]);

    //     $indikator = AuditIndicator::findOrFail($id);

    //     // Simpan file
    //     $file = $request->file('dokumen');
    //     $filename = time() . '_' . $file->getClientOriginalName();
    //     $file->storeAs('public/dokumen', $filename);

    //     // Update kolom dokumen
    //     $indikator->update(['dokumen' => $filename]);

    //     return back()->with('success', 'Dokumen berhasil diupload');
    // }
}
