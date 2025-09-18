@extends('layouts.app')

@section('content')
<div class="master-wrapper">
    <h2>Master Status Pegawai</h2>

    <button @click="document.getElementById('addForm').classList.add('active')" class="btn-add mb-4">Tambah Status Pegawai</button>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-2 rounded">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Status</th>
                <th>Jenis Pegawai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jenisPegawai ? $item->jenisPegawai->nama : '-' }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('master.statusPegawai.edit',$item->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('master.statusPegawai.delete',$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-gray-500">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div id="addForm" class="modal">
        <div class="modal-content">
            <h3 class="mb-2 text-blue-600">Tambah Status Pegawai</h3>
            <form action="{{ route('master.statusPegawai.store') }}" method="POST">
                @csrf
                <input type="text" name="nama" placeholder="Nama Status Pegawai" class="w-full border p-2 rounded mb-2" required>
                <select name="jenis_pegawai_id" class="w-full border p-2 rounded mb-2" required>
                    <option value="">-- Pilih Jenis Pegawai --</option>
                    @foreach($jenis as $j)
                        <option value="{{ $j->id }}">{{ $j->nama }}</option>
                    @endforeach
                </select>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="document.getElementById('addForm').classList.remove('active')" class="bg-gray-400 text-white px-3 py-2 rounded">Batal</button>
                    <button type="submit" class="btn-add">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
