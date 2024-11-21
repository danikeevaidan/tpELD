<?php
namespace App\Http\Controllers;

use App\Events\DriverStatusChanged;
use App\Models\EldData;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class EldDataController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'driver_id' => 'required|exists:drivers,id',
            'log_time' => 'required|date',
            'status' => 'required|in:driving,resting,off_duty,on_duty',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->only([
            'driver_id',
            'log_time',
            'status',
            'latitude',
            'longitude'
        ]);

        $result = $this->saveEldData($data);

        if ($result['status'] === 'success') {
            return response()->json([
                'status' => 'success',
                'message' => 'Data received and saved successfully',
                'data' => $result['data']
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
            ], 500);
        }
    }

    public function saveEldData($data)
    {
        try {
            DB::beginTransaction();

            $eldData = EldData::create([
                'driver_id' => $data['driver_id'],
                'log_time' => $data['log_time'],
                'status' => $data['status'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
            ]);

            DB::commit();

            return [
                'status' => 'success',
                'data' => $eldData
            ];

        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Error saving ELD data: ' . $e->getMessage());

            return $this->retrySave($data);
        }
    }
    private function retrySave($data, $attempt = 1)
    {
        $maxAttempts = 3;
        $delay = 2;

        if ($attempt <= $maxAttempts) {
            sleep($delay);
            try {
                DB::beginTransaction();

                $eldData = EldData::create($data);

                DB::commit();

                return [
                    'status' => 'success',
                    'data' => $eldData
                ];

            } catch (Exception $e) {
                DB::rollBack();

                Log::error("Retry $attempt: Error saving ELD data: " . $e->getMessage());

                return $this->retrySave($data, ++$attempt);
            }
        }

        return [
            'status' => 'error',
            'message' => 'Failed to save data after multiple threats'
        ];
    }

}
