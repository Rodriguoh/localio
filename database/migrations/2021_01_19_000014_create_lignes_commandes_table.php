<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLignesCommandesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'lignes_commandes';

    /**
     * Run the migrations.
     * @table Ligne Commande
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {

            $table->foreignId('produit_id')->constrained();
            $table->foreignId('commande_id')->constrained();

            $table->integer('quantite');
            $table->decimal('prixProduit', 10, 2);

            $table->primary(['produit_id', 'commande_id']);
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
