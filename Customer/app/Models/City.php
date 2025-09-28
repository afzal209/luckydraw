<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class City extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'city';
    
    
//     public function donors()
//     {
//         return $this->hasMany(Donor::class, 'city_id', 'id');
//     }

//   public function applicant()
//     {
//         return $this->hasMany(Applicant::class, 'city_id', 'id');
//     }
}
