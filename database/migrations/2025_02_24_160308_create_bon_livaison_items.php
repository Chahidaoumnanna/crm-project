<?php
//
//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Support\Facades\Schema;
//
//return new class extends Migration
//{
//    /**
//     * Run the migrations.
//     */
//    public function up(): void
//    {
//        Schema::create('bon_livraison_items', function (Blueprint $table) {
//            $table->id();
//            $table->timestamps();
//        });
//    }
//
//    /**
//     * Reverse the migrations.
//     */
//    public function down(): void
//    {
//        Schema::dropIfExists('bon_livraison_items');
//    }
//};
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bon_livraison_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProduit')->constrained('produits');
            $table->foreignId('idBonDeLivraison')->constrained('bon_livraisons');
            $table->integer('qte');
            $table->decimal('prixUnitaire', 10, 2);
            $table->decimal('total', 10, 2); // <-- Nouveau champ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bon_livraison_items');
    }
};
