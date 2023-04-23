<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('plugin_tag', function (Blueprint $table): void {
            //$table->foreignUuid('plugin_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('tag_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plugin_tag');
    }
};
