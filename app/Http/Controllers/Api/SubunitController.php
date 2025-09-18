<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subunit;
use Illuminate\Http\Request;

class SubunitController extends Controller
{
    public function index() { return Subunit::with('unit')->get(); }
    public function store(Request $req) { return Subunit::create($req->all()); }
    public function update(Request $req, Subunit $subunit) { $subunit->update($req->all()); return $subunit; }
    public function destroy(Subunit $subunit) { $subunit->delete(); return response()->json(['deleted'=>true]); }
}

