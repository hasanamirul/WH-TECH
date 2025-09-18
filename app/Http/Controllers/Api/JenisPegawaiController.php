<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisPegawai;
use Illuminate\Http\Request;

class JenisPegawaiController extends Controller
{
    public function index() { return JenisPegawai::all(); }
    public function store(Request $req) { return JenisPegawai::create($req->all()); }
    public function update(Request $req, JenisPegawai $jenisPegawai) { $jenisPegawai->update($req->all()); return $jenisPegawai; }
    public function destroy(JenisPegawai $jenisPegawai) { $jenisPegawai->delete(); return response()->json(['deleted'=>true]); }
}
