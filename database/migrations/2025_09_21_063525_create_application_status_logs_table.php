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
        Schema::create('application_status_logs', function (Blueprint $table) {
            $table->id();
            $table->string('application_id');
            $table->foreign('application_id')
                ->references('application_id')
                ->on('applications')
                ->onDelete('cascade');
            $table->string('from_status');
            $table->string('to_status');
            $table->string('changed_by');
            $table->timestamp('changed_at');
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
        Schema::dropIfExists('application_status_logs');
    }
};
