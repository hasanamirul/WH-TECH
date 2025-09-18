<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StatusPegawai;
use Illuminate\Http\Request;

class StatusPegawaiController extends Controller
{
    public function index() { return StatusPegawai::with('jenisPegawai')->get(); }
    public function store(Request $req) { return StatusPegawai::create($req->all()); }
    public function update(Request $req, StatusPegawai $statusPegawai) { $statusPegawai->update($req->all()); return $statusPegawai; }
    public function destroy(StatusPegawai $statusPegawai) { $statusPegawai->delete(); return response()->json(['deleted'=>true]); }
}

