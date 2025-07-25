<?php

namespace App\Http\Controllers;

use App\Models\PelaksanaanAudit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\APelaksanaanAudit;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class PelaksanaanAuditController extends Controller
{
    public function index()
{
    $data = PelaksanaanAudit::all();
    if (Auth::user()->role === 'auditee' || Auth::user()->role === 'auditor') {
        return view('pelaksanaan.index_auditee', compact('data'));
    } else {
        return view('pelaksanaan.index', compact('data'));
    }

    
}
public function store(Request $request)
{
    if (Auth::user()->role !== 'lead_auditor') {
        abort(403, 'Unauthorized');
    }

    $request->validate([
        'standar' => 'required|string|max:255',
        'indikator' => 'required',
        'kode' => 'required|string|max:255',
    ]);

    PelaksanaanAudit::create([
        'standar' => $request->standar,
        'indikator' => $request->indikator,
        'kode' => $request->kode,
        // kolom lainnya dikosongkan dulu
    ]);

    return redirect()->route('pelaksanaan.index')->with('success', 'Data berhasil ditambahkan');
}


public function update(Request $request, $id)
{
    $pelaksanaanAudit = PelaksanaanAudit::findOrFail($id);

    if (Auth::user()->role === 'lead_auditor') {
        // Lead auditor hanya boleh update standar, indikator, kode
        $request->validate([
            'standar' => 'required|string|max:255',
            'indikator' => 'required',
            'kode' => 'required|string|max:255',
        ]);

        $pelaksanaanAudit->update([
            'standar' => $request->standar,
            'indikator' => $request->indikator,
            'kode' => $request->kode,
        ]);
    }

    if (Auth::user()->role === 'auditor') {
        // Auditor bisa mengisi temuan, kepatuhan, akar masalah
        $request->validate([
            'temuan' => 'nullable|string',
            'kepatuhan' => 'required|string',
            'akar_masalah' => 'nullable|string',
            'tanggapan_auditi' => 'nullable|string',
        ]);

        $pelaksanaanAudit->update([
            'temuan' => $request->temuan,
            'kepatuhan' => $request->kepatuhan,
            'akar_masalah' => $request->akar_masalah,
             'tanggapan_auditi' => $request->tanggapan_auditi,
        ]);
    }

    if (Auth::user()->role === 'auditee') {
        // Auditee bisa mengisi tanggapan auditi
        
    }

    return redirect()->route('pelaksanaan.index')->with('success', 'Data berhasil diperbarui');
}




public function destroy($id)
{
    $pelaksanaanAudit = PelaksanaanAudit::findOrFail($id);
    $pelaksanaanAudit->delete();
    return redirect()->route('pelaksanaan.index')->with('success', 'Data berhasil dihapus');
}
 public function uploadDokumen(Request $request, $id)
    {
          //dd('Fungsi uploadDokumen berhasil dipanggil');
        if (Auth::user()->role !== 'auditee') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'dokumen' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:2048',
        ]);

        $indikator = PelaksanaanAudit::findOrFail($id);

        // Simpan file
        $file = $request->file('dokumen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/dokumen', $filename);

        // Update kolom dokumen
        $indikator->update(['dokumen' => $filename]);
        

        return back()->with('success', 'Dokumen berhasil diupload');
    }
 

    public function simpanTanggapan(Request $request, $id)
    {
        if (Auth::user()->role !== 'auditor') {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'tanggapan_auditor' => 'required|string',
        ]);

        $data = PelaksanaanAudit::findOrFail($id);
        $data->update([
            'tanggapan_auditor' => $request->tanggapan_auditor,
        ]);

        return back()->with('success', 'Tanggapan auditor berhasil disimpan.');
    }


    public function exportWord()
    {
        if (Auth::user()->role !== 'auditor') {
            abort(403, 'Anda tidak memiliki izin untuk mengakses fitur ini.');
        }
        $data = \App\Models\PelaksanaanAudit::all(); 

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText('Laporan Kertas Kerja Auditor Lapangan', ['bold' => true, 'size' => 16], ['alignment' => 'center']);
        $section->addTextBreak();

        $table = $section->addTable([
            'borderSize' => 6,
            'borderColor' => '999999',
            'cellMargin' => 80,
        ]);


        $table->addRow();
        $headers = ['No', 'Standar', 'Indikator', 'Kode', 'Temuan', 'Kepatuhan', 'Tanggapan Auditi', 'Akar Masalah'];
        foreach ($headers as $header) {
            $table->addCell(2000, ['bgColor' => '212529'])->addText($header, ['bold' => true, 'color' => 'FFFFFF']);
        }




        foreach ($data as $i => $item) {
            $table->addRow();
            $table->addCell(200)->addText($i + 1);
            $table->addCell(2000)->addText($item->standar);
            $table->addCell(4000)->addText($item->indikator);
            $table->addCell(1000)->addText($item->kode);
            $table->addCell(2000)->addText($item->temuan ?? '-');
            $table->addCell(1500)->addText($item->kepatuhan);
            $table->addCell(2000)->addText($item->tanggapan_auditi ?? '-');
            $table->addCell(2000)->addText($item->akar_masalah ?? '-');
        }

        $fileName = 'Laporan-Kertas-Kerja-Auditor.docx';
        $filePath = storage_path($fileName);

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }


}
