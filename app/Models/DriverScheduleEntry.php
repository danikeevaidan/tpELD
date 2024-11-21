<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRevisions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;

class DriverScheduleEntry extends Model
{
    use HasRevisions, HasFactory;
    const STATUSES = [1,2,3,4];
    const STATUS_LABELS = ['Driving', 'On Duty', 'Off Duty', 'Resting'];
    protected $fillable = [
        'published',
        'title',
        'description',
        'driver_id',
        'status',
        'log_time',
        'longitude',
        'latitude'
    ];

    public function driver() {
        return $this->belongsTo(Driver::class);
    }

}
