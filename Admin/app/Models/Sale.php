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

    // protected $fillable = [
    //     'luckydraw_id', // Add this line
    //     'customer_id',
    //     'partner_id',
    //     'price',
    //     'qty',
    //     'discount',
    //     'tax',
    //     'ticket_id',
    //     // Add other fillable columns here
    // ];
    protected $fillable = ['ticket_id', 'customer_id', 'partner_id', 'luckydraw_id', 'template_id', 'price', 'qty', 'discount', 'tax', 'amount', 'sale_image_path', 'ticket_download_id', 'created_at', 'updated_at', 'draw_date', 'declare_date', 'status', 'winner_status'];

    public function luckydraw()
    {
        return $this->belongsTo(Luckydraw::class, 'luckydraw_id', 'id');
    }    
    
    public function template()
    {
        return $this->belongsTo(LuckydrawTemplate::class, 'template_id');
    }
}
