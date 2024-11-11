<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\DriverScheduleEntry;

class DriverScheduleEntryRepository extends ModuleRepository
{
    use HandleRevisions;

    public function __construct(DriverScheduleEntry $model)
    {
        $this->model = $model;
    }
}
