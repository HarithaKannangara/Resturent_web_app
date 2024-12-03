<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('selected_concessions'); // JSON of selected concession IDs
            $table->dateTime('send_to_kitchen_time'); // When to send the order to the kitchen
            $table->enum('status', ['Pending', 'In-Progress', 'Completed'])->default('Pending');
            $table->timestamps();
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
