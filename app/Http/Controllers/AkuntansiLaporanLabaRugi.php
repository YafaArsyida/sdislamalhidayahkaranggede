<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AkuntansiLaporanLabaRugi extends Controller
{
    public function index()
    {
        return view('LAPORAN-AKUNTANSI.laporan-laba-rugi.v_index');
    }
}
