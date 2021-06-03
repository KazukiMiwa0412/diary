<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['pic_name'];
    
    public function diary(){
        return $this->belongsTo(\App\Diary::class);
    }
}
