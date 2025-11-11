<?php
namespace App;
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageDetail extends Model
{
    use HasFactory;
    protected $table = 'page_details'; 
    protected $fillable = [
        'start_to_destination',
        'vehicle_price',
        
    ];

   
}


?>