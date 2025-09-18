<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPegawai extends Model
{
    protected $fillable = ['nama', 'jenis_pegawai_id'];

    public function jenisPegawai()
    {
        return $this->belongsTo(JenisPegawai::class, 'jenis_pegawai_id');
    }
}
