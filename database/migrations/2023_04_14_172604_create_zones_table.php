<?php

use App\Models\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('price_per_hour');

            $table->timestamps();
        });

        Zone::create(['name' => 'Green Zone', 'price_per_hour' => 3]);
        Zone::create(['name' => 'Yellow Zone', 'price_per_hour' => 6]);
        Zone::create(['name' => 'Blue Zone', 'price_per_hour' => 9]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
