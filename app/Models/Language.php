<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'Languages';
    protected $fillable = ['abbr','locale','name','direction','active','created_at','updated_at'];


    public function scopeActive($query){
        return $query -> where('active',1);
    }

    public function scopeSelection($query){
        return $query -> select('id','abbr','locale','name','direction','active');
    }

    public function getActive(){
        return $this -> active == 1 ? 'مفعل' : 'غير مفعل';
    }
}

