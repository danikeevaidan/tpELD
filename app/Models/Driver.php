<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasRelated;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model implements Sortable
{
    use HasSlug, HasMedias, HasFiles, HasRevisions, HasPosition, HasFactory, HasRelated;

    protected $fillable = [
        'published',
        'title',
        'description',
        'position',
    ];

    public $slugAttributes = [
        'title',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function schedule_entries(): HasMany
    {
        return $this->hasMany(DriverScheduleEntry::class);
    }
}
