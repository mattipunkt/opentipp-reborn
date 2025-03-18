<?php

use App\Models\GameType;
use App\Models\Team;
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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class, 'team1_id')->onDelete('cascade');
            $table->foreignIdFor(Team::class, 'team2_id')->onDelete('cascade');
            $table->integer('team1_score')->nullable();
            $table->integer('team2_score')->nullable();
            $table->dateTime('time')->nullable();
            $table->boolean('is_finished')->default(false);
            $table->boolean('is_started')->default(false);
            $table->foreignIdFor(GameType::class, 'game_type')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
