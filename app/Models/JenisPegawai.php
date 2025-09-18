<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPegawai extends Model
{
    protected $fillable = ['nama'];

    public function statusPegawai()
    {
        return $this->hasMany(StatusPegawai::class, 'jenis_pegawai_id');
    }
}
