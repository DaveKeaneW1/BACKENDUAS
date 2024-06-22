<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("no_order");
            $table->string("alamat_pengiriman")->nullable();
            $table->integer("total")->nullable();
            $table->foreignId('customer_id')->constrained('customers');
            $table->dateTime("tanggal_pemesanan")->nullable();
            $table->dateTime("tanggal_pembayaran")->nullable();
            $table->dateTime("tanggal_pengiriman")->nullable();
            $table->string("jenis_pengiriman")->nullable();
            $table->binary('bukti_pembayaran')->nullable();
            $table->integer("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
