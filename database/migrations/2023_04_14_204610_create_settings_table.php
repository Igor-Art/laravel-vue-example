<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', static function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
