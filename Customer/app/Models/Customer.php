<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'customers';
    protected $fillable = [
        'prefix',    
        'first_name', // Add this
        'last_name',  // Add other fields as needed
        'email',
        'mobile',
        'password',
        'customer_id',
        'bp_id',
        'address_line_1',
        'address_line_2',
        'country_id',
        'state_id',
        'city_id',
        'zip_code',
        'profile_image',
        'national_id_photo',
        'national_id_number',
        'dob',
        'status',
    ];
}
