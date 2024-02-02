<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bobot;
use App\Models\Kayu;
use App\Models\Kriteria;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'title' => 'Home'
        ]);
    }

    public function perhitungan()
    {
        return view('dashboard.perhitungan', [
            'bobotData' => Bobot::all(),
            'kriteriaData' => Kriteria::all(),
            'kayuData' => Kayu::all(),
            'title' => 'Perhitungan'
        ]);
    }

    public function perhitungan_error()
    {
        return view('dashboard.perhitungan_error', [
            'bobotData' => Bobot::all(),
            'kriteriaData' => Kriteria::all(),
            'kayuData' => Kayu::all(),
            'title' => 'Perhitungan'
        ]);
    }
}
