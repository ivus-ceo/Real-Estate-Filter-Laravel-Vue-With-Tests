<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{Selection};

return new class extends Migration {
    public function up(): void
    {
        Schema::create('selectionables', function (Blueprint $table) {
            $table->foreignIdFor(Selection::class);
            $table->morphs('selectionable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selectionables');
    }
};
