<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Prize_Distribution extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'prize_distribution';
    
    protected $fillable = [
        'prize_id',
        'tx_remarks', 
        'tx_status', 
        'tx_proof',
        // Add other columns that should be mass assignable
    ];
}
