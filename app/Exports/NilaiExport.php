<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromCollection, WithHeadings
{
    public function collection() {
        // join untuk ambil nama siswa juga
        return Nilai::query()
            ->with('siswa')
            ->get()
            ->map(fn($n)=>[
                'nama'    => $n->siswa?->nama,
                'kelas'   => $n->kelas,
                'mapel'   => $n->mapel,
                'nilai'   => $n->nilai,
            ]);
    }

    public function headings(): array {
        return ['nama','kelas','mapel','nilai'];
    }
}
