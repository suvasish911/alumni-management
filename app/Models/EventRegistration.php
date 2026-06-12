<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'participant_name',
        'phone',
        'email',
        'transaction_id',
        'amount',
        'amount_paid',
        'status',
        'payment_status'
    ];

    /**
     * Get the event that this registration belongs to.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}