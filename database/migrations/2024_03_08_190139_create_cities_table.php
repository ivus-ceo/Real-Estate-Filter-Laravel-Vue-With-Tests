<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Region;

return new class extends Migration {
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('latitude');
            $table->float('longitude');
            $table->foreignIdFor(Region::class)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
