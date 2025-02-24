

//ModifierProduit.jsx
import React from 'react';
import { useDispatch } from 'react-redux';
import { updateProduct} from "../../redux/crudActionSlice.js";
import ProduitForm from "./ProduitForm.jsx";

const ModifierProduit = ({ editingProduct, onSubmitSuccess }) => {
    const dispatch = useDispatch();

    const handleSubmit = (product) => {
        dispatch(updateProduct(product));
        onSubmitSuccess();
    };

    return (
        <ProduitForm
            initialProduct={editingProduct}
            onSubmit={handleSubmit}
            articles={[]} // Vous pouvez passer la liste des articles ici si nécessaire
            handleSearchChange={() => {}}
            handleKeyDown={() => {}}
            filteredProducts={[]} // Vous pouvez passer la liste filtrée des articles ici si nécessaire
        />
    );
};

export default ModifierProduit;
