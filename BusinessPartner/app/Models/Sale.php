<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Sale extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'sales';

    protected $fillable = [
        'luckydraw_id', // Add this line
        'customer_id',
        'partner_id',
        'price',
        'qty',
        'discount',
        'tax',
        'amount',
        'draw_date',
        'ticket_id',
        'ticket_download_id',
        'template_id'
        // Add other fillable columns here
    ];
   
    // public function donors()
    // {
    //     return $this->hasMany(Donor::class, 'state_id', 'id');
    // }
    
    
    //  public function applicant()
    // {
    //     return $this->hasMany(Applicant::class, 'state_id', 'id');
    // }
}
