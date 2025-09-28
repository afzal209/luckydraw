<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     
     use SoftDeletes;
    protected $table = 'country';
    
    
    //public function city()
    //{
    //    return $this->belongsTo(City::class, 'city_id', 'id');
    //}

    //public function district()
    //{
    //    return $this->belongsTo(District::class, 'district_id', 'id');
    //}

    //public function state()
    //{
    //    return $this->belongsTo(State::class, 'state_id', 'id');
    //}

   
}
