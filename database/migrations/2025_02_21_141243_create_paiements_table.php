<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('IdBonLivraison')->constrained('bon_livraisons')->onDelete('cascade'); // Clé étrangère
            $table->date('echeanceAt'); // Date d'échéance du paiement
            $table->decimal('montant', 10, 2); // Montant du paiement
            $table->string('mode'); // Mode de paiement (ex: Espèce, Chèque, Virement)
            $table->softDeletes(); // Pour la suppression douce
            $table->timestamps(); // Ajoute created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiements');
    }
};
