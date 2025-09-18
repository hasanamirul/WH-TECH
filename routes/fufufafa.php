ini jeni pegawai blade.php

@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Master Jenis Pegawai</h2>

    <button @click="document.getElementById('addForm').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3">Tambah Jenis Pegawai</button>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-2 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Status Pegawai</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $i+1 }}</td>
                    <td class="p-2 border">{{ $item->nama }}</td>
                    <td class="p-2 border">
                        @foreach($item->statusPegawai as $status)
                            <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded text-sm mr-1">{{ $status->nama }}</span>
                        @endforeach
                    </td>
                    <td class="p-2 border flex gap-2">
                        <a href="{{ route('master.jenisPegawai.edit',$item->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                        <form action="{{ route('master.jenisPegawai.delete',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="addForm" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-4 rounded w-96">
            <h3 class="font-semibold mb-2 text-blue-600">Tambah Jenis Pegawai</h3>
            <form action="{{ route('master.jenisPegawai.store') }}" method="POST">
                @csrf
                <input type="text" name="nama" placeholder="Nama Jenis Pegawai" class="w-full border p-2 rounded mb-2" required>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="document.getElementById('addForm').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


ini statusPegawai.blade.php --

@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Master Status Pegawai</h2>

    <!-- Button Tambah -->
    <button @click="document.getElementById('addForm').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3 hover:bg-blue-600">
        Tambah Status Pegawai
    </button>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-2 rounded">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama Status</th>
                    <th class="p-2 border">Jenis Pegawai</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $i+1 }}</td>
                    <td class="p-2 border">{{ $item->nama }}</td>
                    <td class="p-2 border">
                        @if($item->jenisPegawai)
                            <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded text-sm">{{ $item->jenisPegawai->nama }}</span>
                        @else
                            <span class="text-gray-500">-</span>
                        @endif
                    </td>
                    <td class="p-2 border flex gap-2">
                        <a href="{{ route('master.statusPegawai.edit',$item->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('master.statusPegawai.delete',$item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($data->count() == 0)
                <tr>
                    <td colspan="4" class="p-2 text-center text-gray-500">Belum ada data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="addForm" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-4 rounded w-96">
            <h3 class="font-semibold mb-2 text-blue-600">Tambah Status Pegawai</h3>
            <form action="{{ route('master.statusPegawai.store') }}" method="POST">
                @csrf
                <input type="text" name="nama" placeholder="Nama Status Pegawai" class="w-full border p-2 rounded mb-2" required>
                <div class="mb-2">
                    <label class="block mb-1 font-medium">Jenis Pegawai</label>
                    <select name="jenis_pegawai_id" class="w-full border p-2 rounded" required>
                        <option value="">-- Pilih Jenis Pegawai --</option>
                        @foreach($jenis as $j)
                            <option value="{{ $j->id }}">{{ $j->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="document.getElementById('addForm').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


ini agama.blade.php

@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Master Agama</h2>

    <!-- Button Tambah -->
    <button @click="document.getElementById('addForm').style.display='flex'" 
        class="px-4 py-2 bg-blue-500 text-white rounded mb-3 hover:bg-blue-600 transition">
        Tambah Agama
    </button>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-2 rounded">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded shadow">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama Agama</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $i => $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border text-center">{{ $i + 1 }}</td>
                    <td class="p-2 border">{{ $item->nama }}</td>
                    <td class="p-2 border flex gap-2 justify-center">
                        <a href="{{ route('master.agama.edit', $item->id) }}" 
                            class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('master.agama.delete', $item->id) }}" method="POST" 
                            onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-3 text-center text-gray-500">Belum ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add Form Modal -->
    <div id="addForm" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-96 p-5 shadow-lg">
            <h3 class="text-lg font-semibold mb-3 text-blue-600">Tambah Agama</h3>
            <form action="{{ route('master.agama.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="block mb-1 font-medium">Nama Agama</label>
                    <input type="text" name="nama" class="w-full border rounded p-2" 
                        placeholder="Contoh: Islam" required>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" 
                        @click="document.getElementById('addForm').style.display='none'" 
                        class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


ini unit.blade.php

@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Master Agama</h2>

    <!-- Button Tambah -->
    <button @click="document.getElementById('addForm').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3 hover:bg-blue-600">
        Tambah Agama
    </button>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-2 rounded">{{ session('success') }}</div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama Agama</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $i+1 }}</td>
                    <td class="p-2 border">{{ $item->nama }}</td>
                    <td class="p-2 border flex gap-2">
                        <a href="{{ route('master.agama.edit',$item->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('master.agama.delete',$item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @if($data->count() == 0)
                <tr>
                    <td colspan="3" class="p-2 text-center text-gray-500">Belum ada data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="addForm" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-4 rounded w-96">
            <h3 class="font-semibold mb-2 text-blue-600">Tambah Agama</h3>
            <form action="{{ route('master.agama.store') }}" method="POST">
                @csrf
                <input type="text" name="nama" placeholder="Nama Agama" class="w-full border p-2 rounded mb-2" required>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="document.getElementById('addForm').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Batal</button>
                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


ini subunit.blade.php 

@extends('layouts.app')

@section('content')
<div class="p-4">
    <h2 class="text-2xl font-semibold mb-4 text-blue-600">Master Sub Unit</h2>

    <button @click="document.getElementById('addForm').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3">Tambah Sub Unit</button>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-2 rounded">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="p-2 border">No</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Unit</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $i => $item)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border">{{ $i+1 }}</td>
                    <td class="p-2 border">{{ $item->nama }}</td>
                    <td class="p-2 border">{{ $item->unit->nama }}</td>
                    <td class="p-2 border flex gap-2">
                        <a href="{{ route('master.subunit.edit',$item->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                        <form action="{{ route('master.subunit.delete',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah -->
    <div id="addForm" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-4 rounded w-96">
            <h3 class="font-semibold mb-2 text-blue-600">Tambah Sub Unit</h3>
            <form action="{{ route('master.subunit.store') }}" method="POST">
                @csrf
                <input type="text" name="nama" placeholder="Nama Sub Unit" class="w-full border p-2 rounded mb-2" required>
                <select name="unit_id" class="w-full border p-2 rounded mb-2" required>
                    <option value="">Pilih Unit</option>
                    @foreach($units as $u)
                        <option value="{{ $u->id }}">{{ $u->nama }}</option>
                    @endforeach
                </select>
                <div class="flex justify-end gap-2">
                    <button type="button" @click="document.getElementById('addForm').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
