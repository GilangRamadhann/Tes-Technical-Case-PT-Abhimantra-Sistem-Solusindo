<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use App\Models\Siswa;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request) {
        $q = Siswa::query()
            ->when($request->search, fn($x)=>$x->where('nama','ilike','%'.$request->search.'%')
                                               ->orWhere('kelas','ilike','%'.$request->search.'%'))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Siswa/Index', [
            'items' => $q,
            'filters' => $request->only('search'),
        ]);
    }

    public function store(SiswaRequest $request) {
        Siswa::create($request->validated());
        return back()->with('success','Siswa ditambahkan.');
    }

    public function update(SiswaRequest $request, Siswa $siswa) {
        $siswa->update($request->validated());
        return back()->with('success','Siswa diperbarui.');
    }

    public function destroy(Siswa $siswa) {
        $siswa->delete();
        return back()->with('success','Siswa dihapus.');
    }
}
