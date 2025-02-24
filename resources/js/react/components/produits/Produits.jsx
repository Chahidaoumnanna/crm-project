
import React, { useState } from 'react';
import AjouterProduits from "./AjouterProduit.jsx";
import ListeProduits from "./ListeProduits.jsx";
import ModifierProduit from "./ModifierProduit.jsx";

const Produits = () => {
    const [editingProduct, setEditingProduct] = useState(null);

    const handleEdit = (product) => {
        setEditingProduct(product);
    };

    const handleCloseEdit = () => {
        setEditingProduct(null);
    };

    return (
        <div>
            <h1 className="text-center">Gestion des produits</h1>
            {editingProduct ? (
                <ModifierProduit
                    editingProduct={editingProduct}
                    onSubmitSuccess={handleCloseEdit}
                />
            ) : (
                <AjouterProduits handleEdit={handleEdit} />
            )}
            <ListeProduits handleEdit={handleEdit} />
        </div>
    );
};

export default Produits;
