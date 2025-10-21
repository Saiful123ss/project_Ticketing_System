<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id('ticket_id');
            $table->unsignedBigInteger('client_id');
            $table->string('title');
            $table->text('description');
            $table->string('category')->nullable();
            $table->string('status')->default('open');
            $table->string('track_key', 40)->nullable();
            $table->timestamps();

            $table->foreign('client_id')->references('client_id')->on('client')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
