<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('custom_product_sessions', function (Blueprint $table) {
            $table->string('preview_image_path')->nullable()->after('configuration');
            $table->decimal('unit_price_snapshot', 10, 2)->nullable()->after('preview_image_path');
        });
    }

    public function down(): void
    {
        Schema::table('custom_product_sessions', function (Blueprint $table) {
            $table->dropColumn([
                'preview_image_path',
                'unit_price_snapshot',
            ]);
        });
    }
};
