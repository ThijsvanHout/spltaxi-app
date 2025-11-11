<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prices_per_city extends Model
{
    use HasFactory;
    protected $table = 'prices_per_city';

    protected $fillable = ['id', 'plaats', 'sedan', 'station', 'bus_6', 'bus_8'];
}