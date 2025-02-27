import React from "react";
import { useSelector } from "react-redux";
import axios from "axios";
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";

const BonLivraison = () => {
    const listeProducts = useSelector((state) => state.products.listeproducts);
    const selectedClient = useSelector((state) => state.rechercheClient.selectedClient);

    const handleSaveBonLivraison = async () => {
        if (!selectedClient || !selectedClient.name) {
            alert("Sélectionnez un client avant d'enregistrer !");
            return;
        }

        if (listeProducts.length === 0) {
            alert("Sélectionnez au moins un produit !");
            return;
        }

        try {
            // ⿡ Création du bon de livraison
            const bonLivraisonResponse = await axios.post("http://127.0.0.1:8000/api/bon-de-livraison", {
                idClient: selectedClient.id,
                ref: selectedClient.code.client,
            });

            const idBonDeLivraison = bonLivraisonResponse.data.data.id;

            // ⿢ Préparation des produits avec l'ID du bon de livraison
            const products = listeProducts.map(product => ({
                idProduit: product.id,
                qte: product.qte,
                prixUnitaire: product.prixRevient,
            }));

            // ⿣ Envoi des produits associés au bon de livraison
            await axios.post("http://127.0.0.1:8000/api/bonLivraisonItem", {
                idBonDeLivraison,
                products,
            });

            alert("Bon de livraison et produits enregistrés avec succès !");

            // ⿤ Générer et afficher le PDF après enregistrement
            generatePDF(selectedClient, idBonDeLivraison, products);
        } catch (error) {
            console.error("Erreur lors de l'enregistrement :", error.response || error.message);
            alert("Une erreur est survenue lors de l'enregistrement.");
        }
    };

    // Fonction pour générer le PDF


    return (
        <div>
            <h2>Produits du Bon de Livraison</h2>
            <button onClick={handleSaveBonLivraison}>Enregistrer Bon de Livraison</button>
        </div>
    );
};

export default BonLivraison;
