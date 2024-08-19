<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('No title');
            $table->mediumtext('description')->nullable();
            $table->integer('bid')->default(0);
            $table->string('service_experience')->default('Professional');
            $table->string('service_pay_type')->default('Fixed');
            $table->string('service_duration')->nullable();
            $table->foreignId('user_id')
                        ->constrained()
                        ->onUpdate('cascade')
                        ->onDelete('cascade')
                        ->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
