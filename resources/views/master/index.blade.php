@extends('layouts.app')

@section('content')
<div class="p-4 space-y-8">

    {{-- ================= Jenis Pegawai ================= --}}
    <div>
        <h2 class="text-2xl font-semibold mb-4 text-blue-600">Jenis Pegawai</h2>
        <button @click="document.getElementById('addJenisPegawai').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3">Tambah Jenis Pegawai</button>

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
                    @foreach($jenisPegawai as $i => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $i+1 }}</td>
                        <td class="p-2 border">{{ $item->nama }}</td>
                        <td class="p-2 border">
                            @foreach($item->statusPegawai as $status)
                                <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded text-sm mr-1">{{ $status->nama }}</span>
                            @endforeach
                        </td>
                        <td class="p-2 border flex gap-2">
                            <button @click="document.getElementById('editJenisPegawai{{ $item->id }}').style.display='flex'" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('master.jenisPegawai.delete',$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div id="editJenisPegawai{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                        <div class="bg-white p-4 rounded w-96">
                            <h3 class="font-semibold mb-2 text-blue-600">Edit Jenis Pegawai</h3>
                            <form action="{{ route('master.jenisPegawai.update',$item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nama" value="{{ $item->nama }}" placeholder="Nama Jenis Pegawai" class="w-full border p-2 rounded mb-2" required>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="document.getElementById('editJenisPegawai{{ $item->id }}').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah --}}
        <div id="addJenisPegawai" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white p-4 rounded w-96">
                <h3 class="font-semibold mb-2 text-blue-600">Tambah Jenis Pegawai</h3>
                <form action="{{ route('master.jenisPegawai.store') }}" method="POST">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Jenis Pegawai" class="w-full border p-2 rounded mb-2" required>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="document.getElementById('addJenisPegawai').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                        <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= Status Pegawai ================= --}}
    <div>
        <h2 class="text-2xl font-semibold mb-4 text-blue-600">Status Pegawai</h2>
        <button @click="document.getElementById('addStatusPegawai').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3">Tambah Status Pegawai</button>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded">
                <thead class="bg-blue-100 text-blue-800">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Jenis Pegawai</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statusPegawai as $i => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $i+1 }}</td>
                        <td class="p-2 border">{{ $item->nama }}</td>
                        <td class="p-2 border">{{ $item->jenisPegawai->nama ?? '-' }}</td>
                        <td class="p-2 border flex gap-2">
                            <button @click="document.getElementById('editStatusPegawai{{ $item->id }}').style.display='flex'" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('master.statusPegawai.delete',$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit Status --}}
                    <div id="editStatusPegawai{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                        <div class="bg-white p-4 rounded w-96">
                            <h3 class="font-semibold mb-2 text-blue-600">Edit Status Pegawai</h3>
                            <form action="{{ route('master.statusPegawai.update',$item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nama" value="{{ $item->nama }}" placeholder="Nama Status Pegawai" class="w-full border p-2 rounded mb-2" required>
                                <select name="jenis_pegawai_id" class="w-full border p-2 rounded mb-2" required>
                                    @foreach($jenisPegawai as $jp)
                                        <option value="{{ $jp->id }}" {{ $item->jenis_pegawai_id==$jp->id?'selected':'' }}>{{ $jp->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="document.getElementById('editStatusPegawai{{ $item->id }}').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah Status --}}
        <div id="addStatusPegawai" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white p-4 rounded w-96">
                <h3 class="font-semibold mb-2 text-blue-600">Tambah Status Pegawai</h3>
                <form action="{{ route('master.statusPegawai.store') }}" method="POST">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Status Pegawai" class="w-full border p-2 rounded mb-2" required>
                    <select name="jenis_pegawai_id" class="w-full border p-2 rounded mb-2" required>
                        @foreach($jenisPegawai as $jp)
                            <option value="{{ $jp->id }}">{{ $jp->nama }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="document.getElementById('addStatusPegawai').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                        <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= Agama ================= --}}
    <div>
        <h2 class="text-2xl font-semibold mb-4 text-blue-600">Agama</h2>
        <button @click="document.getElementById('addAgama').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3">Tambah Agama</button>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded">
                <thead class="bg-blue-100 text-blue-800">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agamas as $i => $item)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $i+1 }}</td>
                        <td class="p-2 border">{{ $item->nama }}</td>
                        <td class="p-2 border flex gap-2">
                            <button @click="document.getElementById('editAgama{{ $item->id }}').style.display='flex'" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('master.agama.delete',$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit Agama --}}
                    <div id="editAgama{{ $item->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                        <div class="bg-white p-4 rounded w-96">
                            <h3 class="font-semibold mb-2 text-blue-600">Edit Agama</h3>
                            <form action="{{ route('master.agama.update',$item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nama" value="{{ $item->nama }}" placeholder="Nama Agama" class="w-full border p-2 rounded mb-2" required>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="document.getElementById('editAgama{{ $item->id }}').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah Agama --}}
        <div id="addAgama" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white p-4 rounded w-96">
                <h3 class="font-semibold mb-2 text-blue-600">Tambah Agama</h3>
                <form action="{{ route('master.agama.store') }}" method="POST">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Agama" class="w-full border p-2 rounded mb-2" required>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="document.getElementById('addAgama').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                        <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ================= Unit → Sub Unit ================= --}}
    <div>
        <h2 class="text-2xl font-semibold mb-4 text-blue-600">Unit</h2>
        <button @click="document.getElementById('addUnit').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3">Tambah Unit</button>

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded">
                <thead class="bg-blue-100 text-blue-800">
                    <tr>
                        <th class="p-2 border">No</th>
                        <th class="p-2 border">Nama Unit</th>
                        <th class="p-2 border">Sub Unit</th>
                        <th class="p-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $i => $unit)
                    <tr class="hover:bg-gray-100">
                        <td class="p-2 border">{{ $i+1 }}</td>
                        <td class="p-2 border">{{ $unit->nama }}</td>
                        <td class="p-2 border">
                            @foreach($unit->subUnits as $sub)
                                <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded text-sm mr-1">{{ $sub->nama }}</span>
                            @endforeach
                        </td>
                        <td class="p-2 border flex gap-2">
                            <button @click="document.getElementById('editUnit{{ $unit->id }}').style.display='flex'" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                            <form action="{{ route('master.unit.delete',$unit->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit Unit --}}
                    <div id="editUnit{{ $unit->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                        <div class="bg-white p-4 rounded w-96">
                            <h3 class="font-semibold mb-2 text-blue-600">Edit Unit</h3>
                            <form action="{{ route('master.unit.update',$unit->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nama" value="{{ $unit->nama }}" placeholder="Nama Unit" class="w-full border p-2 rounded mb-2" required>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="document.getElementById('editUnit{{ $unit->id }}').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                                    <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Modal Tambah Unit --}}
        <div id="addUnit" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
            <div class="bg-white p-4 rounded w-96">
                <h3 class="font-semibold mb-2 text-blue-600">Tambah Unit</h3>
                <form action="{{ route('master.unit.store') }}" method="POST">
                    @csrf
                    <input type="text" name="nama" placeholder="Nama Unit" class="w-full border p-2 rounded mb-2" required>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="document.getElementById('addUnit').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                        <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sub Unit --}}
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4 text-blue-600">Sub Unit</h2>
            <button @click="document.getElementById('addSubUnit').style.display='flex'" class="px-4 py-2 bg-blue-500 text-white rounded mb-3">Tambah Sub Unit</button>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded">
                    <thead class="bg-blue-100 text-blue-800">
                        <tr>
                            <th class="p-2 border">No</th>
                            <th class="p-2 border">Nama Sub Unit</th>
                            <th class="p-2 border">Unit</th>
                            <th class="p-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subUnits as $i => $sub)
                        <tr class="hover:bg-gray-100">
                            <td class="p-2 border">{{ $i+1 }}</td>
                            <td class="p-2 border">{{ $sub->nama }}</td>
                            <td class="p-2 border">{{ $sub->unit->nama ?? '-' }}</td>
                            <td class="p-2 border flex gap-2">
                                <button @click="document.getElementById('editSubUnit{{ $sub->id }}').style.display='flex'" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                                <form action="{{ route('master.subUnit.delete',$sub->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        {{-- Modal Edit Sub Unit --}}
                        <div id="editSubUnit{{ $sub->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                            <div class="bg-white p-4 rounded w-96">
                                <h3 class="font-semibold mb-2 text-blue-600">Edit Sub Unit</h3>
                                <form action="{{ route('master.subUnit.update',$sub->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="nama" value="{{ $sub->nama }}" placeholder="Nama Sub Unit" class="w-full border p-2 rounded mb-2" required>
                                    <select name="unit_id" class="w-full border p-2 rounded mb-2" required>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $sub->unit_id==$unit->id?'selected':'' }}>{{ $unit->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="flex justify-end gap-2">
                                        <button type="button" @click="document.getElementById('editSubUnit{{ $sub->id }}').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                                        <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Modal Tambah Sub Unit --}}
            <div id="addSubUnit" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
                <div class="bg-white p-4 rounded w-96">
                    <h3 class="font-semibold mb-2 text-blue-600">Tambah Sub Unit</h3>
                    <form action="{{ route('master.subUnit.store') }}" method="POST">
                        @csrf
                        <input type="text" name="nama" placeholder="Nama Sub Unit" class="w-full border p-2 rounded mb-2" required>
                        <select name="unit_id" class="w-full border p-2 rounded mb-2" required>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                            @endforeach
                        </select>
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="document.getElementById('addSubUnit').style.display='none'" class="px-3 py-2 bg-gray-400 text-white rounded">Batal</button>
                            <button type="submit" class="px-3 py-2 bg-blue-500 text-white rounded">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
