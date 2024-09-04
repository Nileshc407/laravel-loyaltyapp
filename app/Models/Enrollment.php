<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $table ="enrollment_master";
    protected $primaryKey = "id";

    function Country()
    {
        return $this->hasOne('App\Models\Country','id','country_id'); 
    }
    function State()
    {
        return $this->hasOne('App\Models\State','id','state_id');
    }
    function City()
    {
        return $this->hasOne('App\Models\City','id','city_id');
    }
}
