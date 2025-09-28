<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class State extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'state';

   
    // public function donors()
    // {
    //     return $this->hasMany(Donor::class, 'state_id', 'id');
    // }
    
    
    //  public function applicant()
    // {
    //     return $this->hasMany(Applicant::class, 'state_id', 'id');
    // }
}
