<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_items', function (Blueprint $table): void {
            $table->longText('image_data')->nullable()->after('image_path');
            $table->string('image_mime')->nullable()->after('image_data');
        });
    }

    public function down(): void
    {
        Schema::table('gallery_items', function (Blueprint $table): void {
            $table->dropColumn(['image_data', 'image_mime']);
        });
    }
};
