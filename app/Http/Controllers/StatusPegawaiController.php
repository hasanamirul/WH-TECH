<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPegawai;
use App\Models\JenisPegawai;

class StatusPegawaiController extends Controller
{
    public function index()
    {
        $status = StatusPegawai::with('jenisPegawai')->get();
        $jenis = JenisPegawai::all();

        return view('master.status_pegawai', compact('status','jenis'));
    }
}
