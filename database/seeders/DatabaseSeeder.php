<?php

namespace Database\Seeders;

use A17\Twill\Models\Media;
use App\Models\Driver;
use App\Models\DriverScheduleEntry;
use App\Models\Notification;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        $users = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $count = 10;
        $users->each(function ($user) use ($count) {
           $user->notifications()->saveMany(
               Notification::factory()->count($count)->make()
           );
        });

        $drivers = Driver::factory($count)->create();
        $drivers->each(function ($driver) use ($count) {
            $driver
                ->schedule_entries()
                ->saveMany(
                    DriverScheduleEntry::factory()
                        ->count($count*4)
                        ->create()
                );
        });
        $vehicles = Vehicle::factory($count)->create();


        // Creating fake images
        $disk = Config::get('twill.media_library.disk');

        $medias = [];
        for($i=1; $i<=6; $i++){
            $filename = $i . '.jpeg';
            $filePath = database_path('seeders/images/') . $filename;
            $uuid = Str::uuid();
            list($w, $h) = getimagesize($filePath);

            Storage::disk($disk)->put($uuid . '/' . $filename, file_get_contents($filePath));
            $medias[] = Media::create([
                'uuid' => $uuid . '/' . $filename,
                'filename' => $filename,
                'caption' => '',
                'alt_text' => '',
                'width' => $w,
                'height' => $h,
            ]);
        }

        foreach($vehicles as $vehicle) {
            $vehicle->medias()->attach($medias[rand(0, 5)]->id, ['metadatas' => '{}']);
        }

        for($i=1; $i<=$count; $i++){
            DB::table('twill_related')->insert([
                'position' => $i,
                'subject_id' => $i,
                'subject_type' => 'App\\Models\\Driver',
                'related_id' => $i,
                'related_type' => 'App\\Models\\Vehicle',
                'browser_name' => 'vehicle'
            ]);
        }

        DB::table('twill_users')->insert([
            'published' => 1,
            'created_at' => now(),
            'name' => 'Test Admin',
            'is_superadmin' => 1,
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
            'registered_at' => now(),
        ]);

    }
}
