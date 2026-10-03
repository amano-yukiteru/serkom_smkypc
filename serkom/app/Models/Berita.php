<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'beritas';
    protected $guarded = [];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
