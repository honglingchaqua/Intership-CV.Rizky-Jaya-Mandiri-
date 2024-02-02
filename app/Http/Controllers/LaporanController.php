<?php

namespace App\Http\Controllers;

use App\Models\Bobot;
use Illuminate\Http\Request;
use App\Models\Kayu;

class LaporanController extends Controller
{
    public function index()
    {
        return view('dashboard.laporan', [
            'kayuData' => Kayu::all(),
            'bobotData' => new Bobot(),
            'title' => 'Laporan'
        ]);
    }
}
