


import React, { useState, useEffect } from 'react';
import Select from 'react-select';
import { FaToggleOn, FaToggleOff } from 'react-icons/fa';
import 'bootstrap/dist/css/bootstrap.min.css';
import {calculateValues} from "@/react/components/produits/Calcule.jsx";
import { useDispatch, useSelector } from 'react-redux';
import { toggleTva, toggleRemise } from "../../redux/activationTvaRemiseSlice.js";

const ProduitForm = ({ initialProduct, onSubmit, articles, handleSearchChange, handleKeyDown, filteredProducts, isManualEntry, setIsManualEntry }) => {
    const dispatch = useDispatch();
    const isTvaActive = useSelector((state) => state.activation.isTvaActive);
    const isRemiseActive = useSelector((state) => state.activation.isRemiseActive);

    const [product, setProduct] = useState({
        code: '',
        name: '',
        tva: 0,
        remise: 0,
        qte: 0,
        prixVente: 0,
        prixRevient: 0,
        pht: 0,
        total: 0,
        Remise:0,
        ...initialProduct
    });

    const [selectedProduct, setSelectedProduct] = useState(
        initialProduct.name
            ? { label: initialProduct.name, value: initialProduct.id }
            : null
    );

    // Fonction pour calculer le Prix HT
    const calculatePrixHT = (prixVente, tva) => {
        return isTvaActive ? prixVente / (1 + tva / 100) : prixVente;
    };

    useEffect(() => {
        const updatedProduct = {
            code: '',
            name: '',
            tva: 0,
            remise: 0,
            qte: 0,
            prixVente: 0,
            prixRevient: 0,
            pht: 0,
            total: 0,
            Remise:0,
            ...initialProduct
        };

        // Recalculer le Prix HT si la TVA est activée
        if (isTvaActive) {
            updatedProduct.pht = calculatePrixHT(updatedProduct.prixVente, updatedProduct.tva * 100);
        }

        setProduct(updatedProduct);
        setSelectedProduct(
            initialProduct.name
                ? { label: initialProduct.name, value: initialProduct.id }
                : null
        );
    }, [initialProduct, isTvaActive]);

    const handleSelectProduct = (option) => {
        if (!option) return;
        const product = articles.find((p) => p.id === option.value);
        if (product) {
            setSelectedProduct(option);
            const updatedProduct = {
                ...product,
                code: product.code || '',
                id: product.id, // Assurez-vous que l'id est bien récupéré
                name: product.name || '',
                tva: product.tva || 0,
                remise: product.remise || 0,
                qte: product.qte || 0,
                prixVente: product.prixVente || 0,
                prixRevient: product.prixRevient || 0,
                pht: calculatePrixHT(product.prixVente, product.tva ),
                total: product.total || 0,
                Remise: product.remise || 0,
            };
            setProduct(updatedProduct);
        }
    };

    const handleChange = (e) => {
        const { name, value } = e.target;

        // Convertir en nombre uniquement pour les champs numériques
        const updatedValue = (name === 'qte' || name === 'prixVente' || name === 'tva' || name === 'remise')
            ? (value === '' ? '' : parseFloat(value)) // Convertir en nombre si ce n'est pas vide
            : value; // Garder la valeur telle quelle pour les autres champs

        // Mettre à jour l'état du produit
        setProduct((prevProduct) => {
            const updatedProduct = { ...prevProduct, [name]: updatedValue };

            // Recalculer le Prix HT si TVA activée
            if (isTvaActive && (name === 'tva' || name === 'prixVente')) {
                updatedProduct.pht = calculatePrixHT(updatedProduct.prixVente, updatedProduct.tva * 100);
            }

            // Recalculer les valeurs finales (Prix TTC, Total, etc.)
            const calculatedValues = calculateValues(updatedProduct, isTvaActive, isRemiseActive);

            return { ...updatedProduct, ...calculatedValues };
        });
    };

    const handleSubmit = (e) => {
        e.preventDefault();

        // Vérifier si la quantité est valide
        if (product.qte <= 0) {
            alert("La quantité doit être supérieure à zéro");
            return;
        }

        // Si la quantité est valide, soumettre le formulaire
        onSubmit(product);
    };

    const handleToggleTva = () => dispatch(toggleTva());
    const handleToggleRemise = () => dispatch(toggleRemise());

    return (
        <div className="mb-4">
            <div className="bg-white p-3 rounded">
                <h5 className="mb-3 pb-2 border-bottom"> Produits :</h5>

                <div className="d-flex justify-content-start mb-4">
                    <div className="me-4">
                        <div className="d-flex align-items-center" onClick={handleToggleTva} style={{ cursor: 'pointer' }}>
                            {isTvaActive ? <FaToggleOn size={30} color='#88bde4' /> : <FaToggleOff size={30} color="#ccc" />}
                            <span className="ms-2">Activer TVA</span>
                        </div>
                    </div>
                    <div>
                        <div className="d-flex align-items-center" onClick={handleToggleRemise} style={{ cursor: 'pointer' }}>
                            {isRemiseActive ? <FaToggleOn size={30} color='#88bde4' /> : <FaToggleOff size={30} color="#ccc" />}
                            <span className="ms-2">Activer Remise</span>
                        </div>
                    </div>
                </div>

                <form onSubmit={handleSubmit}>
                    <table className="table table-bordered table-hover" >
                        <thead className="thead-light" >
                        <tr >
                            <th style={{ backgroundColor: '#003366', color: 'white' }}>Référence</th>
                            <th style={{ backgroundColor: '#003366', color: 'white' }}>Article</th>
                            {isTvaActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>TVA (%)</th>}
                            {isRemiseActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>Remise (%)</th>}
                            <th style={{ backgroundColor: '#003366', color: 'white' }}>Quantité</th>
                            {isTvaActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>Prix HT</th>}
                            {isTvaActive ? <th style={{ backgroundColor: '#003366', color: 'white' }}>Prix TTC</th> : <th style={{ backgroundColor: '#003366', color: 'white' }}>Prix</th>}
                            <th style={{ backgroundColor: '#003366', color: 'white' }}>Total</th>
                            <th style={{ backgroundColor: '#003366', color: 'white' }}>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input
                                    type="text"
                                    name="code"
                                    id="code"
                                    value={product.code}
                                    onChange={handleChange}
                                    className="form-control"
                                    required
                                />
                            </td>
                            <td>
                                {isManualEntry ? (
                                    <>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            value={product.name}
                                            onChange={handleChange}
                                            className="form-control"
                                            required
                                        />
                                    </>
                                ) : (
                                    <>
                                        <Select
                                            name="name"
                                            id="name"
                                            value={selectedProduct}
                                            onInputChange={handleSearchChange}
                                            onChange={handleSelectProduct}
                                            onKeyDown={handleKeyDown}
                                            options={filteredProducts.map(p => ({ label: p.name, value: p.id }))}
                                            className="form-control"
                                        />
                                        {/*<small*/}
                                        {/*    className="text-muted"*/}
                                        {/*    style={{ cursor: 'pointer', color: 'blue' }}*/}
                                        {/*    onClick={() => setIsManualEntry(true)}*/}
                                        {/*>*/}
                                        {/*    Ajouter un nouvel name*/}
                                        {/*</small>*/}
                                    </>
                                )}
                            </td>
                            {isTvaActive && (
                                <td>
                                    <select
                                        name="tva"
                                        id="tva"
                                        value={product}
                                        onChange={(e) => {
                                            const tvaValue = parseFloat(e.target.value);
                                            handleChange({ target: { name: 'tva', value: tvaValue } });
                                        }}
                                        className="form-control"
                                        required
                                    >
                                        <option value={0}>0%</option>
                                        <option value={0.7}>7%</option>
                                        <option value={10}>10%</option>
                                        <option value={0.14}>14%</option>
                                        <option value={20}>20%</option>
                                    </select>
                                </td>
                            )}
                            {isRemiseActive && (
                                <td>
                                    <input
                                        type="number"
                                        name="remise"
                                        id="remise"
                                        value={product.remise}
                                        onChange={handleChange}
                                        className="form-control"
                                        min="0"
                                        step="0.01"
                                    />
                                    {selectedProduct && (
                                        <small
                                            className="text-muted"
                                            title="Remise d'achat"
                                            style={{ cursor: 'pointer', backgroundColor: '#f0f0f0', padding: '2px 4px', borderRadius: '4px' }}
                                        >
                                            R.A: {product.Remise}
                                        </small>
                                    )}
                                </td>
                            )}
                            <td>
                                <input
                                    type="number"
                                    name="qte"
                                    value={product.qte}
                                    onChange={handleChange}
                                    className="form-control"
                                    required
                                />

                            </td>
                            {isTvaActive && (
                                <td>
                                    <input
                                        type="number"
                                        name="pht"
                                        id="pht"
                                        value={product.pht}
                                        onChange={handleChange}
                                        className="form-control"
                                        readOnly
                                    />
                                </td>
                            )}
                            {isTvaActive ? (
                                <td>
                                    <input
                                        type="number"
                                        name="prixVente"
                                        id="prixVente"
                                        value={product.prixVente}
                                        onChange={handleChange}
                                        className="form-control"
                                    />
                                    {selectedProduct && (
                                        <small
                                            className="text-muted"
                                            title="Prix Revient"
                                            style={{ cursor: 'pointer', backgroundColor: '#f0f0f0', padding: '2px 4px', borderRadius: '4px' }}
                                        >
                                            P.R: {product.prixRevient}
                                        </small>
                                    )}
                                </td>
                            ) : (
                                <td>
                                    <input
                                        type="number"
                                        name="prixVente"
                                        id="prixVente"
                                        value={product.prixVente}
                                        onChange={handleChange}
                                        className="form-control"
                                    />
                                    {selectedProduct && (
                                        <small
                                            className="text-muted"
                                            title="Prix Revient"
                                            style={{ cursor: 'pointer', backgroundColor: '#f0f0f0', padding: '2px 4px', borderRadius: '4px' }}
                                        >
                                            P.R: {product.prixRevient}
                                        </small>
                                    )}
                                </td>
                            )}
                            <td>
                                <input
                                    type="number"
                                    name="total"
                                    id="total"
                                    value={product.total}
                                    onChange={handleChange}
                                    className="form-control"
                                    readOnly // Total est calculé automatiquement
                                />
                            </td>
                            <td>
                                <button type="submit" className="btn" style={{backgroundColor:'#88bde4', color:'white'}}>Enregistrer</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    );
};

export default ProduitForm;


