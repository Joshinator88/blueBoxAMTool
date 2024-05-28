<?php

use App\Models\Master;
use App\Models\Partner;
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
        Schema::create('master_partner', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Master::class);
            $table->foreignIdFor(Partner::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_partner');
    }
};
