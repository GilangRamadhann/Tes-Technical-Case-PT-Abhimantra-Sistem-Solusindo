<?php

namespace App\Http\Controllers;

use App\Exports\NilaiExport;
use App\Http\Requests\NilaiRequest;
use App\Imports\NilaiImport;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class NilaiController extends Controller
{
    public function index(Request $request) {
        $items = Nilai::query()
            ->with('siswa')
            ->when($request->kelas, fn($q)=>$q->where('kelas',$request->kelas))
            ->when($request->mapel, fn($q)=>$q->where('mapel',$request->mapel))
            ->when($request->search, function($q) use($request){
                $q->whereHas('siswa', fn($s)=>$s->where('nama','ilike','%'.$request->search.'%'));
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Nilai/Index', [
            'items'   => $items,
            'filters' => $request->only('kelas','mapel','search'),
            'siswas'  => Siswa::orderBy('nama')->get(['id','nama','kelas']),
            'kelasOpt'=> Nilai::select('kelas')->distinct()->pluck('kelas'),
            'mapelOpt'=> Nilai::select('mapel')->distinct()->pluck('mapel'),
        ]);
    }

    public function store(NilaiRequest $request) {
        Nilai::create($request->validated());
        return back()->with('success','Nilai ditambahkan.');
    }

    public function update(NilaiRequest $request, Nilai $nilai) {
        $nilai->update($request->validated());
        return back()->with('success','Nilai diperbarui.');
    }

    public function destroy(Nilai $nilai) {
        $nilai->delete();
        return back()->with('success','Nilai dihapus.');
    }

    public function import(Request $request) {
        $request->validate([
            'file'=>'required|file|mimes:xlsx,csv,xls'
        ]);
        Excel::import(new NilaiImport, $request->file('file'));
        return back()->with('success','Import berhasil.');
    }

    public function export() {
        return Excel::download(new NilaiExport, 'nilai.xlsx');
    }
}
