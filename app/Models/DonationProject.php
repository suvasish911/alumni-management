<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationProject extends Model
{
    protected $fillable = [
        'name', 
        'description',
        'goal_amount', 
        'raised_amount', 
        'status'
    ];
}
