<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakurikulers';
    protected $guarded = [];
    public function guru(){
        return $this->belongsTo(Guru::class);
    }
}
