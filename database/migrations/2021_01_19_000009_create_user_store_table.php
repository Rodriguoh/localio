<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStoreTable extends Migration
{
    /**
     * = Table FAVORIS
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_store';

    /**
     * Run the migrations.
     * @table user_commerce
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('store_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
