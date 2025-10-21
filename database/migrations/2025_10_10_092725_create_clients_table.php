<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('domain')->nullable();
            $table->string('email')->nullable();
            $table->string('category')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
