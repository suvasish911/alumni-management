<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationCategory extends Model
{
    protected $table = 'donations_categories'; 

    protected $fillable = ['name'];

    public function donations()
    {
        return $this->hasMany(Donation::class, 'donation_category_id');
    }
}
