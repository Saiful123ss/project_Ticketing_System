<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ticket_reply', function (Blueprint $table) {
            $table->id('reply_id');
            $table->unsignedBigInteger('ticket_id');
            $table->string('user_type'); // 'client' or 'admin'
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('message');
            $table->string('attachments')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->foreign('ticket_id')->references('ticket_id')->on('ticket')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket_reply');
    }
};
