<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->index(['customer_id', 'id']);
            $table->index(['assignee_id', 'id']);
            $table->index(['category_id', 'id']);
            $table->fullText('subject')->language('english');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropIndex(['customer_id', 'id']);
            $table->dropIndex(['assignee_id', 'id']);
            $table->dropIndex(['category_id', 'id']);
            $table->dropFullText(['subject']);
        });
    }
};
