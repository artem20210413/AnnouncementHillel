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
        Schema::create('posts', function ($table) {
            $table->id();
            $table->string('title',100);
            $table->string('description',5000);
            $table->unsignedBigInteger('userId');
            $table->timestamps();


            $table->foreign('userId')
                ->references('id')
                ->on('user')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
