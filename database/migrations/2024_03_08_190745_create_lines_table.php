<?php

use App\Models\Metro;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->index();
            $table->foreignIdFor(Metro::class)->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metro_lines');
    }
};
