
import React, { useState, useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import {addProduct , updateProduct} from "../../redux/crudActionSlice.js";
import axios from 'axios';
import ProduitForm from "./ProduitForm.jsx";

const AjouterProduits = () => {
    const dispatch = useDispatch();
    const [names, setArticles] = useState([]);
    const [searchTerm, setSearchTerm] = useState('');
    const [initialProduct, setInitialProduct] = useState({
        code: '',
        name: '',//
        tva: 0,
        remise: 0,
        qte: 0,
        prixVente: 0,
        prixRevient: 0,
        pht: 0,
        total: 0,
        qty: 0,
        Remise : 0,
    });
    const [isManualEntry, setIsManualEntry] = useState(false);

    const listeproducts = useSelector((state) => state.products.listeproducts);

    useEffect(() => {
        const fetchProducts = async () => {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/produits");
                setArticles(response.data);
            } catch (error) {
                console.error('Error fetching products:', error);
                alert('Erreur lors de la récupération des produits.');
            }
        };
        fetchProducts();
    }, []);

    const handleSearchChange = (input) => {
        setSearchTerm(input);
        if (/^\d+$/.test(input)) {
            const product = names.find((p) => p.codebar === input);
            if (product) {
                handleSelectProduct(product);
            }
        }
    };

    const handleKeyDown = (event) => {
        if (event.key === 'Enter' && /^\d+$/.test(searchTerm)) {
            const product = names.find((p) => p.codebar === searchTerm);
            if (product) {
                handleSelectProduct(product);
            }
        }
    };

    const handleSelectProduct = (product) => {
        setInitialProduct({
            id: product.id || '',
            code: product.code || '',
            name: product.name || '',
            tva: product.tva ? parseFloat(product.tva) : 0,
            remise: product.remise ? parseFloat(product.remise) : 0,
            qte: product.qte ? parseInt(product.qte) : 0,
            prixVente: product.prixVente ? parseFloat(product.prixVente) : 0,
            prixRevient: product.prixRevient ? parseFloat(product.prixRevient) : 0,
            pht: product.pht ? parseFloat(product.pht) : 0,
            total: product.total ? parseFloat(product.total) : 0,
            qty: product.qty ? parseInt(product.qty) : 0,
            Remise: product.remise ? parseFloat(product.remise) : 0,
        });
    setSearchTerm(''); // Réinitialiser le champ de recherche
    };

    if (!Array.isArray(names)) {
        console.log("names is not an array:", names);
        return [];
    }
    const filteredProducts = (names || []).filter((p) =>
        p.name.toLowerCase().includes(searchTerm.toLowerCase())
    );



    const handleSubmit = (product) => {
        // Vérifier si la quantité est valide
        if (product.qte <= 0) {
            alert("La quantité doit être supérieure à zéro.");
            return;
        }

        // Vérifier si l'id du produit correspond avant d'ajouter la quantité
        const existingProduct = listeproducts.find((p) => p.id === product.id);

        if (existingProduct) {
            const updatedProduct = {
                ...existingProduct,
                qte: parseFloat(existingProduct.qte) + parseFloat(product.qte),
            };
            dispatch(updateProduct(updatedProduct));
        } else {
            const newProduct = { ...product, id: product.id };
            dispatch(addProduct(newProduct));
        }

        // Réinitialiser le formulaire
        setInitialProduct({
            code: '',
            name: '',
            tva: 0,
            remise: 0,
            qte: 0,
            prixVente: 0,
            prixRevient: 0,
            pht: 0,
            total: 0,
            qty: 0,
            Remise: 0,
        });
        setIsManualEntry(false);
    };

    return (
        <>
            <ProduitForm
                initialProduct={initialProduct}
                onSubmit={handleSubmit}
                names={names}
                handleSearchChange={handleSearchChange}
                handleKeyDown={handleKeyDown}
                filteredProducts={filteredProducts}
                isManualEntry={isManualEntry}
                setIsManualEntry={setIsManualEntry}
            />
        </>
    );
};

export default AjouterProduits;
