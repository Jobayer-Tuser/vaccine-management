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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("vaccine_center_id")
                ->constrained("vaccine_centers")
                ->onDelete("restrict")
                ->onUpdate("cascade");

            $table->string("name");
            $table->string("email");
            $table->string("nid");
            $table->string("phone");
            $table->dateTime("schedule_date");
            $table->string("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table){
            $table->dropForeign(['vaccination_center_id']);
            $table->dropIfExists();
        });
    }
};
