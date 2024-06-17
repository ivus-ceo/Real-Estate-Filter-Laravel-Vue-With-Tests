<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\{City};

return new class extends Migration {
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->index();
            $table->foreignIdFor(City::class)->nullable()->index()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('districts');
    }
};
