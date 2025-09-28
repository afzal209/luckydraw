<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LuckydrawTemplate extends Model
{
    protected $table = 'luckydraw_template';
    protected $fillable = ['template_name'];
} 