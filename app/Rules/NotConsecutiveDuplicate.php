<?php

namespace App\Rules;

use App\Models\DriverScheduleEntry;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotConsecutiveDuplicate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (auth()->user()->driver->schedule_entries->count() > 0) {
            if ($value == auth()->user()->driver->schedule_entries->last()->status) {
                $status = DriverScheduleEntry::STATUS_LABELS[$value-1];
                $fail('The status is already ' . "\"$status\"");
            }
        }
    }
}
