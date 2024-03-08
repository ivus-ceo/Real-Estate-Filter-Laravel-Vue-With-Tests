<?php

use App\Models\Metro;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('metro_lines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Metro::class);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metro_lines');
    }
};
