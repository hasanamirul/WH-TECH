<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPegawai;
use App\Models\StatusPegawai;
use App\Models\Agama;
use App\Models\Unit;
use App\Models\SubUnit;

class MasterController extends Controller
{
    // ===================== Jenis Pegawai =====================
    public function jenisPegawai()
    {
        $data = JenisPegawai::with('statusPegawai')->get(); // penting: load relasi
        return view('master.jenis_pegawai', compact('data'));
    }

    public function jenisPegawaiStore(Request $request)
    {
        JenisPegawai::create($request->only('nama'));
        return redirect()->route('master.jenisPegawai')->with('success', 'Data berhasil ditambahkan');
    }

    public function jenisPegawaiEdit($id)
    {
        $item = JenisPegawai::findOrFail($id);
        return view('master.jenis_pegawai_edit', compact('item'));
    }

    public function jenisPegawaiUpdate(Request $request, $id)
    {
        $item = JenisPegawai::findOrFail($id);
        $item->update($request->only('nama'));
        return redirect()->route('master.jenisPegawai')->with('success', 'Data berhasil diupdate');
    }

    public function jenisPegawaiDelete($id)
    {
        JenisPegawai::findOrFail($id)->delete();
        return redirect()->route('master.jenisPegawai')->with('success', 'Data berhasil dihapus');
    }

    // ===================== Status Pegawai =====================
    public function statusPegawai()
    {
        $data = StatusPegawai::all();
        $jenis = JenisPegawai::all();
        return view('master.status_pegawai', compact('data', 'jenis'));
    }

    public function statusPegawaiStore(Request $request)
    {
        StatusPegawai::create($request->only('nama'));
        return redirect()->route('master.statusPegawai')->with('success', 'Data berhasil ditambahkan');
    }

    public function statusPegawaiEdit($id)
    {
        $item = StatusPegawai::findOrFail($id);
        $jenis = JenisPegawai::all();
        return view('master.status_pegawai_edit', compact('item', 'jenis'));
    }


    public function statusPegawaiUpdate(Request $request, $id)
    {
        StatusPegawai::findOrFail($id)->update($request->only('nama'));
        return redirect()->route('master.statusPegawai')->with('success', 'Data berhasil diupdate');
    }

    public function statusPegawaiDelete($id)
    {
        StatusPegawai::findOrFail($id)->delete();
        return redirect()->route('master.statusPegawai')->with('success', 'Data berhasil dihapus');
    }

    // ===================== Agama =====================
    public function agama()
    {
        $data = Agama::all();
        return view('master.agama', compact('data'));
    }

    public function agamaStore(Request $request)
    {
        Agama::create($request->only('nama'));
        return redirect()->route('master.agama')->with('success', 'Data berhasil ditambahkan');
    }


    public function agamaEdit($id)
    {
        $item = Agama::findOrFail($id);
        return view('master.agama_edit', compact('item'));
    }

    public function agamaUpdate(Request $request, $id)
    {
        Agama::findOrFail($id)->update($request->only('nama'));
        return redirect()->route('master.agama')->with('success', 'Data berhasil diupdate');
    }

    public function agamaDelete($id)
    {
        Agama::findOrFail($id)->delete();
        return redirect()->route('master.agama')->with('success', 'Data berhasil dihapus');
    }

    // ===================== Unit =====================
    // ===================== Unit =====================
    // ===================== Unit =====================
    public function unit()
    {
        $data = Unit::with('subUnits')->get(); // ambil relasi Sub Unit kalau perlu
        return view('master.unit', compact('data'));
    }

    public function unitStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string'
        ]);

        Unit::create($request->only('nama'));
        return redirect()->route('master.unit')->with('success', 'Data berhasil ditambahkan');
    }


    public function unitEdit($id)
    {
        $item = Unit::findOrFail($id);
        return view('master.unit_edit', compact('item'));
    }

    public function unitUpdate(Request $request, $id)
    {
        Unit::findOrFail($id)->update($request->only('nama'));
        return redirect()->route('master.unit')->with('success', 'Data berhasil diupdate');
    }

    public function unitDelete($id)
    {
        Unit::findOrFail($id)->delete();
        return redirect()->route('master.unit')->with('success', 'Data berhasil dihapus');
    }

    // ===================== Sub Unit =====================
    // ===================== Sub Unit =====================
    public function subunit()
    {
        $data = SubUnit::with('unit')->get(); // ambil relasi unit juga
        $units = Unit::all(); // untuk dropdown
        return view('master.subunit', compact('data', 'units'));
    }

    public function subunitStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'unit_id' => 'required|exists:units,id'
        ]);

        SubUnit::create($request->only('nama', 'unit_id'));
        return redirect()->route('master.subunit')->with('success', 'Data berhasil ditambahkan');
    }


    public function subunitEdit($id)
    {
        $item = SubUnit::findOrFail($id);
        return view('master.subunit_edit', compact('item'));
    }

    public function subunitUpdate(Request $request, $id)
    {
        SubUnit::findOrFail($id)->update($request->only('nama'));
        return redirect()->route('master.subunit')->with('success', 'Data berhasil diupdate');
    }

    public function subunitDelete($id)
    {
        SubUnit::findOrFail($id)->delete();
        return redirect()->route('master.subunit')->with('success', 'Data berhasil dihapus');
    }
}
