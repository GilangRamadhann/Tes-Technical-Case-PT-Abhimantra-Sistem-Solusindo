<?php
namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        // Data untuk kartu statistik
        $stat = [
            'siswa' => Siswa::count(),
            'nilai' => Nilai::count(),
        ];

        // Data tabel + filter (reuse logic dari halaman Nilai)
        $items = Nilai::query()
            ->with('siswa')
            ->when($request->kelas, fn($q) => $q->where('kelas', $request->kelas))
            ->when($request->mapel, fn($q) => $q->where('mapel', $request->mapel))
            ->when($request->search, function($q) use ($request){
                $q->whereHas('siswa', fn($s) => $s->where('nama','ilike','%'.$request->search.'%'));
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Dashboard', [
            'stat'     => $stat,
            'items'    => $items,
            'filters'  => $request->only('kelas','mapel','search'),
            'siswas'   => Siswa::orderBy('nama')->get(['id','nama','kelas']),
            'kelasOpt' => Nilai::select('kelas')->distinct()->pluck('kelas'),
            'mapelOpt' => Nilai::select('mapel')->distinct()->pluck('mapel'),
        ]);
    }
}
