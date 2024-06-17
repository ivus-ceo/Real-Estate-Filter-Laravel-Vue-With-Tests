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
            $table->foreignIdFor(Floor::class)->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Building::class)->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rooms');
    }
};
