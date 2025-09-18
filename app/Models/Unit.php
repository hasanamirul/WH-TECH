<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['nama_unit'];

    public function subunits()
    {
        return $this->hasMany(Subunit::class);
    }
}

