<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_name', 
        'donation_amount', 
        'donation_category_id', 
        'payment_method', 
        'receiver_name'
    ];
    public function category()
    {
        return $this->belongsTo(DonationCategory::class, 'donation_category_id');
    }
}
