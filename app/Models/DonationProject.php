<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationProject extends Model
{
    use softDeletes;
    protected $fillable = [
        'name', 
        'description',
        'goal_amount', 
        'raised_amount', 
        'status'
    ];
}
