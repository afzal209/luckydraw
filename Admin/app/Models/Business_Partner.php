<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extend this
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business_Partner extends Authenticatable
{
    use HasFactory, Notifiable,SoftDeletes;

    protected $table = 'business_partners'; // Ensure your table name is correct
    
    protected $fillable = [
        'poc_email', 
        'open_password', 
        'business_name',
        'status'
        // Add other columns that should be mass assignable
    ];

    protected $hidden = [
        'open_password', // Hide password when returning JSON
    ];

    protected $casts = [
        'open_password' => 'string', // Ensure it’s a string
    ];

    // Relationships
    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\City::class, 'city_id');
    }    
}
