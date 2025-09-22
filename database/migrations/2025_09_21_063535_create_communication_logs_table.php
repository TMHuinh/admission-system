<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('communication_logs', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('application_id')
            //     ->constrained('applications')
            //     ->onDelete('cascade');
            $table->id();
            $table->string('application_id');
            $table->foreign('application_id')
                ->references('application_id')
                ->on('applications')
                ->onDelete('cascade');
            $table->string('action');
            $table->enum('template', ['payment_due', 'document_due', 'interview_reminder']);
            $table->string('sent_to');
            $table->timestamp('sent_at');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communication_logs');
    }
};
