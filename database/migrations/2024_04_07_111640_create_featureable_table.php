<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('featureables', function (Blueprint $table) {
            $table->foreignIdFor('feature_id')->index();
            $table->morphs('featureable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('featureables');
    }
};
