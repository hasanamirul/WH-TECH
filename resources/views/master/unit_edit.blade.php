@extends('layouts.app')

@section('content')
<div class="card" style="max-width:500px;margin:auto">
    <h2 class="mb-4">Edit Unit</h2>

    @if(session('success'))
        <div style="margin-bottom:12px;color:green">{{ session('success') }}</div>
    @endif

    <form action="{{ route('master.unit.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nama Unit</label>
        <input type="text" name="nama" value="{{ $item->nama }}" class="px-3 py-2 border rounded w-full mb-4" required>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
        <a href="{{ route('master.unit') }}" class="px-4 py-2 bg-gray-300 rounded ml-2">Kembali</a>
    </form>
</div>
@endsection
