<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    //
    use HasFactory;

    protected $table = 'events_categories';
    protected $fillable = ['name'];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'category_id');
    }
}
