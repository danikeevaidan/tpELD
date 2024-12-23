<?php

use App\Models\DriverScheduleEntry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('driver_schedule_entries', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            // feel free to modify the name of this column, but title is supported by default (you would need to specify the name of the column Twill should consider as your "title" column in your module controller if you change it)
            $table->enum('status', DriverScheduleEntry::STATUSES);
            $table->foreignId('driver_id')->constrained('drivers')->cascadeOnDelete();
            $table->dateTime('log_time');

            // your generated model and form include a description field, to get you started, but feel free to get rid of it if you don't need it
            $table->text('description')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('driver_schedule_entry_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'driver_schedule_entry');
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_schedule_entry_revisions');
        Schema::dropIfExists('driver_schedule_entries');
    }
};
