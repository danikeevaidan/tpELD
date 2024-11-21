<?php

namespace App\Http\Controllers\Api;

use App\Events\DriverStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\DriverScheduleEntry;
use App\Rules\NotConsecutiveDuplicate;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ScheduleEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'int', 'min:1', 'max:4', new NotConsecutiveDuplicate()],
            'driver_id' => 'required|exists:drivers,id',
            'log_time' => 'required|date|before_or_equal:now',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);

        if ($validator->fails()) {
            event(new DriverStatusChanged($validator->errors()->first(), 'error'));
            return response()->json($validator->errors(), 422);
        }

        $entry = new DriverScheduleEntry($validator->validated());
        $last_entry = auth()->user()->driver->schedule_entries->last();

        $current_status = DriverScheduleEntry::STATUS_LABELS[$entry->status-1];
        $last_status = DriverScheduleEntry::STATUS_LABELS[$last_entry->status-1];


        $this_entry_log_time = new DateTime($entry->log_time);
        $last_entry_log_time = new DateTime($last_entry->log_time);
        $period = $this_entry_log_time->diff($last_entry_log_time)->format('%d days, %h hours, %i minutes, %s seconds');

        $entry->save();
        event(new DriverStatusChanged("Period from last status ($last_status) to current status ($current_status) is $period", 'info'));
        return response([
                "Period from last status ($last_status) to current status ($current_status) is $period"
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverScheduleEntry $driverScheduleEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DriverScheduleEntry $driverScheduleEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriverScheduleEntry $driverScheduleEntry)
    {
        //
    }
}
