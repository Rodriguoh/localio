<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommercesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'commerces';

    /**
     * Run the migrations.
     * @table Commerce
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->text('desc')->nullable();
            $table->string('codeAvis', 10)->nullable();
            $table->string('numero', 15);
            $table->string('rue', 45);
            $table->string('tel', 20);
            $table->string('mail', 80);
            $table->string('SIRET', 14);
            $table->string('url')->nullable();
            $table->decimal('lat', 8, 5)->nullable();
            $table->decimal('lng', 8, 5)->nullable();
            $table->string('livraison', 1)->nullable();
            $table->string('conditionLivraison')->nullable();
            $table->text('horairesOuverture')->nullable();

            $table->foreignId('user_id')->constrained();

            $table->foreignId('etat_id')->nullable()->constrained();

            $table->foreignId('ville_INSEE')->references('INSEE')->on('villes');

            $table->foreignId('categorie_id')->constrained();
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
        Schema::dropIfExists($this->tableName);
    }
}
