<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemvendorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemvendors', function(Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('item_id')->unsigned();
			$table->integer('vendor_id')->unsigned();
			$table->boolean('confirmed')->default(0);
			$table->decimal('last_known_price',10,2)->default(0);
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
        Schema::drop('itemvendors');
    }

}
