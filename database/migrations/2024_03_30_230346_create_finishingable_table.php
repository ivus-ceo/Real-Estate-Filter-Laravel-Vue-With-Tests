<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finishingables', function (Blueprint $table) {
            $table->foreignIdFor('finishing_id')->index();
            $table->morphs('finishingable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finishingables');
    }
};
