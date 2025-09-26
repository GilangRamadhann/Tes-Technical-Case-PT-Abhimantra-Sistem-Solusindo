<?php

namespace App\Imports;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiImport implements ToCollection
{
    /**
     * Format kolom (header di file Excel):
     * nama | kelas | mapel | nilai
     */
    public function collection(Collection $rows)
    {
        // skip header
        $data = $rows->skip(1);

        foreach ($data as $row) {
            $nama  = trim((string) $row[0]);
            $kelas = trim((string) $row[1]);
            $mapel = trim((string) $row[2]);
            $nilai = (int) $row[3];

            if(!$nama || !$kelas || !$mapel) continue;

            $siswa = Siswa::firstOrCreate(['nama'=>$nama, 'kelas'=>$kelas]);
            Nilai::create([
                'siswa_id' => $siswa->id,
                'kelas'    => $kelas,
                'mapel'    => $mapel,
                'nilai'    => $nilai,
            ]);
        }
    }
}
