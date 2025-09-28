<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'wallet';
    protected $fillable = [
        'bp_id','tx_id','tx_date','amount','tx_type',
        'tx_mode','created_at','status'
    ];

    public function businessPartner()
    {
        return $this->belongsTo(Business_Partner::class, 'bp_id', 'id');
    }
}
