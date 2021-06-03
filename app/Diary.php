<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $table = 'diaries';
    protected $guarded = array('id');
    public $timestamps = true;
    protected $fillable = [
        'title', 
        'text', 
        'date', 
        'user_id',
    ];
    public function getPaginateByLimit(int $limit_count = 5)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function pictures(){
        return $this->hasMany(\App\Picture::class,'diaries_id','id');
    }
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
