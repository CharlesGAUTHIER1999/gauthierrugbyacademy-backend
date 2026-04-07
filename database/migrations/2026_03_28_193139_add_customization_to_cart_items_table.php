<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('custom_product_session_id')->nullable()->after('product_option_id');

            $table->foreign('custom_product_session_id')
                ->references('id')
                ->on('custom_product_sessions')
                ->nullOnDelete();

            $table->index('cart_id');
            $table->index('product_id');
            $table->index('product_option_id');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropUnique('cart_items_cart_id_product_id_product_option_id_unique');
            $table->index(['cart_id', 'product_id', 'product_option_id'], 'cart_items_cart_product_option_index');
        });
    }

    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['custom_product_session_id']);
            $table->dropIndex(['custom_product_session_id']);

            $table->dropIndex(['cart_id']);
            $table->dropIndex(['product_id']);
            $table->dropIndex(['product_option_id']);

            $table->dropIndex('cart_items_cart_product_option_index');

            $table->dropColumn('custom_product_session_id');

            $table->unique(
                ['cart_id', 'product_id', 'product_option_id'],
                'cart_items_cart_id_product_id_product_option_id_unique'
            );
        });
    }
};