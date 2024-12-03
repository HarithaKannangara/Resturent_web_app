<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->json('selected_concessions')->nullable()->change(); // Make JSON
        $table->json('quantity')->nullable()->change();            // Make JSON
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->text('selected_concessions')->change(); // Revert to text
        $table->text('quantity')->change();            // Revert to text
    });
}
};
