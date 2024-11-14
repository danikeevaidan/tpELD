<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRevisions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;

class DriverScheduleEntry extends Model
{
    use HasRevisions, HasFactory;
    const STATUSES = [1, 2, 3, 4];
    protected $fillable = [
        'published',
        'title',
        'description',
        'driver_id',
        'status',
        'longitude',
        'latitude'
    ];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }
}
