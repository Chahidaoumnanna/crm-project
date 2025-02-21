import React, { useEffect, useState } from "react";
import axios from "axios";

const ProduitsList = () => {
    const [produits, setProduits] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        axios.get("http://127.0.0.1:8000/produits")
            .then((response) => {
                setProduits(response.data);
                setLoading(false);
            })
            .catch((error) => {
                setError("Erreur lors de la récupération des produits");
                setLoading(false);
            });
    }, []);

    if (loading) {
        return <p>Chargement en cours...</p>;
    }

    if (error) {
        return <p style={{ color: "red" }}>{error}</p>;
    }

    return (
        <div>
            <h2>Liste des Produits</h2>
            <table border="1">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Code</th>
                    <th>Code-Barres</th>
                    <th>Prix Revient</th>
                    <th>Prix Vente</th>
                    <th>TVA</th>
                    <th>Remise</th>
                </tr>
                </thead>
                <tbody>
                {Array.isArray(produits) && produits.length > 0 ? (
                    produits.map((produit) => (
                        <tr key={produit.id}>
                            <td>{produit.id}</td>
                            <td>{produit.name}</td>
                            <td>{produit.code}</td>
                            <td>{produit.codeBar || "N/A"}</td>
                            <td>{produit.prixRevient} €</td>
                            <td>{produit.prixVente} €</td>
                            <td>{produit.tva} %</td>
                            <td>{produit.remise} %</td>
                        </tr>
                    ))
                ) : (
                    <tr>
                        <td colSpan="8">Aucun produit disponible</td>
                    </tr>
                )}
                </tbody>
            </table>
        </div>
    );
};

export default ProduitsList;
