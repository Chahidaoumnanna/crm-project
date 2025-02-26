import React from "react";
import { useSelector } from "react-redux";
import axios from "axios";

const BonLivraison = () => {
    const listeProducts = useSelector((state) => state.products.listeproducts);
    const selectedClient = useSelector((state) => state.rechercheClient.selectedClient);
    // const client = useSelector((state) => state.rechercheClient.client);

    const handleSaveBonLivraison = async () => {
        console.log(selectedClient);  // Cela vous montre toute la structure de l'objet client
        if (!selectedClient || !selectedClient.name) {
            alert("Sélectionnez un client avant d'enregistrer !");
            return;
        }

        if (listeProducts.length === 0) {
            alert("Sélectionnez au moins un produit !");
            return;
        }

        try {

            // 1. Création du bon de livraison
            const bonLivraisonResponse = await axios.post("http://127.0.0.1:8000/api/bon-de-livraison", {
                idClient: selectedClient.id, // Envoi du client sélectionné
                ref :selectedClient.code.client,
            });

            // console.log(bonLivraisonResponse);
            // return;
            const idBonDeLivraison = bonLivraisonResponse.data.data.id;  // Récupère l'ID du bon de livraison créé

            // 2. Préparation des produits avec l'ID du bon de livraison
            const products = listeProducts.map(product => ({
                idProduit: product.id,
                qte: product.qte,
                prixUnitaire: product.prixRevient,
            }));

            // 3. Envoi des produits associés au bon de livraison
            await axios.post("http://127.0.0.1:8000/api/bonLivraisonItem", {
                idBonDeLivraison,  // Envoi de l'ID du bon de livraison
                products,  // Liste des produits à associer
            });

            alert("Bon de livraison et produits enregistrés avec succès !");
        } catch (error) {
            // Si une erreur se produit, cette section est exécutée
            console.error("Erreur lors de l'enregistrement :", error.response || error.message);

            // Affichage de l'alerte d'erreur uniquement en cas de problème
            alert("Une erreur est survenue lors de l'enregistrement.");
        }
    };

    return (
        <div>
            <h2>Produits du Bon de Livraison</h2>
            <button onClick={handleSaveBonLivraison}>Enregistrer Bon de Livraison</button>
        </div>
    );
};

export default BonLivraison;
