<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';
    protected $guarded = [];
    
    public function eskul(){
        return $this->hasMany(Ekstrakurikuler::class);
    }
}
