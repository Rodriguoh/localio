<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'stores';

    /**
     * Run the migrations.
     * @table Stores
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->string('codeComment', 10)->nullable();
            $table->string('number', 15);
            $table->string('street', 45);
            $table->string('phone', 20);
            $table->string('mail', 80);
            $table->string('SIRET', 20);
            $table->string('url')->nullable();           
            $table->decimal('lat', 8, 5)->nullable();
            $table->decimal('lng', 8, 5)->nullable();
            $table->string('delivery', 1)->nullable();
            $table->string('conditionDelivery')->nullable();          
            $table->text('openingHours')->nullable();

            $table->foreignId('user_id')->constrained();
            
            $table->foreignId('state_id')->nullable()->constrained();

            $table->foreignId('city_INSEE')->references('INSEE')->on('cities');

            $table->foreignId('category_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
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
