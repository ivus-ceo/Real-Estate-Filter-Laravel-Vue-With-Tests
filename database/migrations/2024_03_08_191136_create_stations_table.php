<?php

use App\Models\Line;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Line::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metro_stations');
    }
};
