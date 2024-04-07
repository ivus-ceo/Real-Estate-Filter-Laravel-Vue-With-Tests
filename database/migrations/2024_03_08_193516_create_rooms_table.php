<?php

use App\Models\Building;
use App\Models\Floor;
use App\Models\Finishing;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->index();
            $table->integer('roominess')->index();
            $table->integer('price_sale')->nullable()->index();
            $table->integer('price_rent')->nullable()->index();
            $table->integer('area')->index();
            $table->foreignIdFor(Finishing::class)->index();;
            $table->foreignIdFor(Floor::class)->index();
            $table->foreignIdFor(Building::class)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
