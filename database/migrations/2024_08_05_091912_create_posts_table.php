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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1000);
            $table->string('slug')->unique();
            $table->text('content');
            $table->boolean('is published')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->foreignIdFor(User::class,'post_user_id')->constrained()->cascadeOnDelete();
            //cascade on delete allow to delete the user with all his posts
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
