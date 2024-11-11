<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EldData extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'log_time',
        'status',
        'latitude',
        'longitude',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
