<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'drivers';
	
	protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'car_number', 
        'order' // Voeg de order kolom toe
    ];
	
	protected static function booted()
    {
        static::creating(function ($driver) {
            $maxOrder = self::max('order') ?? 0;
            $driver->order = $maxOrder + 1;
        });
    }
	
    public function bookings()
    {
        return $this->belongsToMany(Booking::class)->withPivot('status')->withTimestamps();
    }

}
