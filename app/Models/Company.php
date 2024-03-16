<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable=['name','email','address','website'];

    public function contact(){
        return $this->hasMany(Contact::class);
    }
    public  function user(){
        return $this->belongsTo(User::class);
    }
}
