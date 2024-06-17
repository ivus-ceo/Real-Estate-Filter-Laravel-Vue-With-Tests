<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Country;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('selections', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->index();
            $table->foreignIdFor(Country::class)->index();
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('selections');
    }
};
