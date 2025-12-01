<?php
// database/migrations/xxxx_xx_xx_create_entries_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('entry_date');
            $table->string('title', 100);
            $table->text('content');
            $table->enum('privacy', ['public', 'friends', 'private'])->default('public');
            $table->string('mood')->nullable();
            $table->boolean('allow_comments')->default(true);
            $table->timestamps();
            
            $table->index(['user_id', 'entry_date']);
        });
        
        Schema::create('entry_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entry_id')->constrained()->onDelete('cascade');
            $table->string('tag');
            $table->timestamps();
            
            $table->index('entry_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entry_tags');
        Schema::dropIfExists('entries');
    }
};