@extends('layouts.app')

@section('content')
    <div class="master-wrapper">
        <h2>Master Unit</h2>

        <button @click="document.getElementById('addForm').classList.add('active')" class="btn-add mb-4">Tambah Unit</button>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-2 rounded">{{ session('success') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Unit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->nama }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('master.unit.edit', $item->id) }}" class="btn-edit">Edit</a>
                            <form action="{{ route('master.unit.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Modal Tambah -->
        <div id="addForm" class="modal">
            <div class="modal-content">
                <h3 class="mb-2 text-blue-600">Tambah Unit</h3>
                <form action="{{ route('master.unit.store') }}" method="POST">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Unit" class="w-full border p-2 rounded mb-2"
                        required>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="document.getElementById('addForm').classList.remove('active')"
                            class="bg-gray-400 text-white px-3 py-2 rounded">Batal</button>
                        <button type="submit" class="btn-add">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
