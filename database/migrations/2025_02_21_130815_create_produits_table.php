<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Constantes pour les valeurs par défaut
    const DEFAULT_TVA = 0;
    const DEFAULT_REMISE = 0;

    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('name')->comment('Désignation du produit'); // Désignation du produit
            $table->string('code')->unique()->comment('Référence unique du produit'); // Référence unique
            $table->string('codeBar')->nullable()->comment('Code-barres du produit'); // Code-barres (optionnel)
            $table->decimal('prixRevient', 10, 2)->comment('Prix de revient du produit'); // Prix de revient
            $table->decimal('prixVente', 10, 2)->comment('Prix de vente du produit'); // Prix de vente
            $table->decimal('tva', 5, 2)->default(self::DEFAULT_TVA)->comment('TVA appliquée au produit'); // TVA
            $table->decimal('remise', 5, 2)->default(self::DEFAULT_REMISE)->comment('Remise appliquée au produit'); // Remise
            $table->timestamps(); // Colonnes 'created_at' et 'updated_at'
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('produits', function (Blueprint $table) {
            $table->dropSoftDeletes(); // Supprime la colonne `deleted_at`
        });
    }
};
