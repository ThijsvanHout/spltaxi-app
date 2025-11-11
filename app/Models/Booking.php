<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    public function drivers()
    {
        return $this->belongsToMany(Driver::class)->withPivot('status')->withTimestamps();
    }

}
