import React from 'react';
import { useSelector } from "react-redux";
import axios from "axios";

const BonDeLivraisonProduits = () => {
    const listeProducts = useSelector((state) => state.products.listeproducts);

    const handleSaveProduits = async () => {
        if (listeProducts.length === 0) {
            alert("Sélectionnez au moins un produit !");
            return;
        }

        const produitsData = {
            products: listeProducts.map(product => ({
                idProduit: product.id,
                qte: product.qte,
                prixUnitaire: product.prixUnitaire,
            })),
        };

        try {
            const response = await axios.post("http://127.0.0.1:8000/api/bonLivraisonItem", produitsData);
            alert("Produits enregistrés avec succès !");
            console.log(response.data);
        } catch (error) {
            console.error("Erreur lors de l'enregistrement :", error);
        }
    };

    return (
        <div>
            <h2>Produits du Bon de Livraison</h2>
            <button onClick={handleSaveProduits}>Enregistrer Produits</button>
        </div>
    );
};
export default BonDeLivraisonProduits;
