<?php

use App\Building;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('building_floors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Building::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('building_floors');
    }
};
