<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('custom_product_session_id')
                ->nullable()
                ->after('product_option_id')
                ->constrained('custom_product_sessions')
                ->nullOnDelete();

            $table->json('customization_snapshot')
                ->nullable()
                ->after('total');

            $table->string('customization_preview_path')
                ->nullable()
                ->after('customization_snapshot');
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['custom_product_session_id']);
            $table->dropColumn([
                'custom_product_session_id',
                'customization_snapshot',
                'customization_preview_path',
            ]);
        });
    }
};
