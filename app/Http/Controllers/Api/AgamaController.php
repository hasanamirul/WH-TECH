<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use Illuminate\Http\Request;

class AgamaController extends Controller
{
    public function index() { return Agama::all(); }
    public function store(Request $req) { return Agama::create($req->all()); }
    public function update(Request $req, Agama $agama) { $agama->update($req->all()); return $agama; }
    public function destroy(Agama $agama) { $agama->delete(); return response()->json(['deleted'=>true]); }
}
