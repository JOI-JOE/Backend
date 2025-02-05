<?php

use App\Models\TeamType;
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
        Schema::create('workspaces', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(model: TeamType::class);
            $table->string('id_member_creator');
            $table->text('desc')->nullable();
            $table->string('display_name');
            $table->string('name')->unique();
            $table->string('logo_hash')->nullable();
            $table->string('logo_url')->nullable();
            $table->enum('visibility', ['private', 'public'])->default('private');
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspaces');
    }
};
