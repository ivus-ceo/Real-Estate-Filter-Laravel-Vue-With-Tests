<?php

use App\Models\Line;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->index();
            $table->foreignIdFor(Line::class)->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metro_stations');
    }
};
