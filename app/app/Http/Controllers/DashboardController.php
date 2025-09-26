<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Siswa;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke() {
        return Inertia::render('Dashboard', [
            'stat' => [
                'siswa' => Siswa::count(),
                'nilai' => Nilai::count(),
            ],
        ]);
    }
}
