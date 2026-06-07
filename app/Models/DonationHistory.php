<?php

namespace App\Models;

use \App\Models\DonationProect;
use Illuminate\Database\Eloquent\Model;

class DonationHistory extends Model
{
    protected $fillable = [
        'user_id', 
        'project_id', 
        'amount', 
        'payment_method',
         'status'
        ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function project() 
    {
        return $this->belongsTo(DonationProject::class,'project_id');
    }
}
