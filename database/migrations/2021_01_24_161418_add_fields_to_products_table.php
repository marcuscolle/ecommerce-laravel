<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



class AddFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //this table add field to our Products table earlier cretate with:
        // php artisan make:model Product -a
        // inside the DB all fields from both tables will be in the same Products table, so 1 table only.
        Schema::table('products', function (Blueprint $table) {
            $table->string('name', 100);
            $table->text('description');
            $table->string('image');
            $table->string('category');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->string('brand');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            //
        });
    }
}
