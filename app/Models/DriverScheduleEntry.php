<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRevisions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;

class DriverScheduleEntry extends Model
{
    use HasRevisions, HasFactory;
    const STATUSES = ['driving', 'on_duty', 'off_duty', 'resting'];
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
