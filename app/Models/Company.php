<?php

namespace App\Models;

use App\Models\Scopes\AllowedFilterSearch;
use App\Models\Scopes\AllowedSort;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory , SoftDeletes ,AllowedSort, AllowedFilterSearch;//
//    public function makeHiddenIf(Request $request, $attributes)
//    {
//    }

    protected $fillable=['name','email','address','website'];

    public function contact(){
        return $this->hasMany(Contact::class);
    }
    public  function user(){
        return $this->belongsTo(User::class);
    }
}
