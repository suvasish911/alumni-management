<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'donation_project_id',
        'donor_name', 
        'donation_amount', 
        'donation_category_id', 
        'payment_method', 
        'transaction_id',
        'status',
        'receiver_name'
    ];
    public function category()
    {
        return $this->belongsTo(DonationCategory::class, 'donation_category_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
