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
        Schema::create('cover_letters', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            // $table->foreignId('proposal_id')->constrained();

            $table->foreignId('proposal_id')
            ->constrained()
            ->onDelete('cascade')
            ->onUpdate('cascade');

        

            $table->timestamps();

            $table->unique('proposal_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cover_letters');
    }
};
