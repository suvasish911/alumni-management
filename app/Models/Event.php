<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'place',
        'organized_by',
        'event_date'
    ];

    // protected $casts = [
    //     'event_date' => 'dateTime',
    // ];

    public function category():BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }
}
