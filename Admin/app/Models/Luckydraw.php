<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Luckydraw  extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
     
    use SoftDeletes;
    protected $table = 'luckydraws';
    
    protected $fillable = ['luckydraw_name','template_id','start_date','end_date'];

    public function templates()
    {
        // template_id can be comma-separated, so handle that separately in controller
        return $this->belongsToMany(LuckydrawTemplate::class, 'sales', 'luckydraw_id', 'template_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'luckydraw_id');
    }    
    
}
