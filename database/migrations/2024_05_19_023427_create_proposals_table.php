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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('emploi_id')->constrained();
            // $table->foreignId('user_id')->constrained();
            

            $table->foreignId('emploi_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
             $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->boolean('validated')->default(0);

            $table->timestamps();

            $table->unique(['emploi_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
