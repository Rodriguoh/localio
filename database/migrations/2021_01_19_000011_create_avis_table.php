<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'avis';

    /**
     * Run the migrations.
     * @table Avis
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->decimal('note', 2, 1);
            $table->text('commentaire');
            $table->dateTime('date')->nullable();
            $table->foreignId('commerce_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
