<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->double('amount', 8, 2);
            $table->text('description')->nullable();
            $table->integer('duration')->default(1);
            $table->string('start_date')->nullable(); // 20-06-2024
            $table->string('end_date')->nullable(); // 25-06-2024
            $table->string('completed_date')->nullable(); // 23-06-2024
            $table->text('agents')->nullable();
            $table->text('tests')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};

# Structure will be :

// "agents": [
//     {
//         "agent_id": 4,
//         "schedules": [
//             {
//                 "uid": "xasd1",
//                 "doctor_id": 1
//             },
//             {
//                 "uid": "xasd2",
//                 "doctor_id": 2
//             }
//         ]
//     },
//     {
//         "agent_id": 5,
//         "schedules": [
//             {
//                 "uid": "xasd3",
//                 "doctor_id": 3
//             },
//             {
//                 "uid": "xasd4",
//                 "doctor_id": 4
//             }
//         ]
//     }
// ],
// "tests": [
//     {
//         "test_id": 1,
//         "target_amount": 35000,
//         "amount_collected": 0
//     },
//     {
//         "test_id": 2,
//         "target_amount": 25000,
//         "amount_collected": 0
//     }
// ]