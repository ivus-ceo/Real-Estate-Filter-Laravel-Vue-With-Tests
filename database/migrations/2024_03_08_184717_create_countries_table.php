<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->unique()->index();
            $table->string('code')->unique()->index();
            $table->string('continent')->index();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
};
