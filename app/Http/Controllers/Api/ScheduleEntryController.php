<?php

namespace App\Http\Controllers\Api;

use App\Events\DriverStatusChanged;
use App\Http\Controllers\Controller;
use App\Models\DriverScheduleEntry;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'status' => 'required|string',
            'driver_id' => 'required|exists:drivers,id',
            'log_time' => 'required|date',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);
        $entry = new DriverScheduleEntry($validated);

        event(new DriverStatusChanged('Driver status changed to ' . $validated['status']));

        $last_entry = auth()->user()->driver->schedule_entries->last();

        $this_entry_log_time = new DateTime($entry->log_time);
        $last_entry_log_time = new DateTime($last_entry->log_time);
        $period = $this_entry_log_time->diff($last_entry_log_time)->format('%d days, %h hours, %i minutes, %s seconds');

        $entry->save();
        return response("Period from last status ($last_entry->status) to current status ($entry->status) is $period",201);
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
