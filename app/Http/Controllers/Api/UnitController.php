<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index() { return Unit::all(); }
    public function store(Request $req) { return Unit::create($req->all()); }
    public function update(Request $req, Unit $unit) { $unit->update($req->all()); return $unit; }
    public function destroy(Unit $unit) { $unit->delete(); return response()->json(['deleted'=>true]); }
}

