<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'category_id',
        'name',
        'place',
        'organized_by',
        'amount',
        'event_type',
        'raised_amount',
        'event_date'
    ];

    // protected $casts = [
    //     'event_date' => 'dateTime',
    // ];

    public function attendees() {
        return $this->belongsToMany(User::class, 'event_registrations')->withPivot('payment_status', 'transaction_id', 'amount_paid')->withTimestamps();
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function donations()
    {
        return $this->hasMany(\App\Models\Donation::class, 'event_id');
    }
}
