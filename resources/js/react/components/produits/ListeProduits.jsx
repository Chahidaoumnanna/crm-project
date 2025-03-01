// import React, { useEffect } from 'react';
// import { useSelector, useDispatch } from 'react-redux';
// import {deleteProduct , updateTotalTTC} from "../../redux/crudActionSlice.js";
// import {calculateValues ,calculateTotals} from "./Calcule.jsx";
//
// const ListeProduits = ({ handleEdit }) => {
//     const dispatch = useDispatch();
//     const listeproducts = useSelector((state) => state.products.listeproducts);
//     const isTvaActive = useSelector((state) => state.activation.isTvaActive);
//     const isRemiseActive = useSelector((state) => state.activation.isRemiseActive);
//     const totalTTC = useSelector((state) => state.products.totalTTC);
//
//     // Calculer les totaux
//     const { totalHT, totalTVA, totalTTC: calculatedTotalTTC } = calculateTotals(
//         listeproducts,
//         isTvaActive,
//         isRemiseActive
//     );
//
//     // Mettre à jour totalTTC dans Redux après le rendu
//     useEffect(() => {
//         dispatch(updateTotalTTC(parseFloat(calculatedTotalTTC)));
//     }, [dispatch, calculatedTotalTTC]);
//
//     return (
//         <div className="container mt-4">
//             <div className="card shadow-sm">
//                 <div className="card-header bg-info text-white">
//                     <h5 className="card-title mb-0">Liste des produits</h5>
//                 </div>
//                 <div className="container">
//                     <div className="row">
//                         <div className="col" style={{ color: "black" }}>
//                             Totale HT : <span style={{ color: 'red' }}>{totalHT}</span>
//                         </div>
//                         {isTvaActive && (
//                             <div className="col" style={{ color: "black" }}>
//                                 Totale TVA : <span style={{ color: 'red' }}>{totalTVA} %</span>
//                             </div>
//                         )}
//                         <div className="col" style={{ color: "black" }}>
//                             Totale TTC : <span style={{ color: 'red' }}>{totalTTC.toFixed(2)}</span>
//                         </div>
//                     </div>
//                 </div>
//                 <div className="card-body">
//                     <div className="row">
//                         <div className="col-12">
//                             <div className="table-responsive">
//                                 <table className="table table-hover table-bordered w-100">
//                                     <thead className="thead-dark">
//                                     <tr>
//                                         <th scope="col">Référence</th>
//                                         <th scope="col">Article</th>
//                                         {isTvaActive && <th scope="col">TVA (%)</th>}
//                                         {isRemiseActive && <th scope="col">Remise (%)</th>}
//                                         <th scope="col">Quantité</th>
//                                         {isTvaActive && <th scope="col">Prix HT</th>}
//                                         {isTvaActive ? <th scope="col">Prix TTC</th> : <th scope="col">Prix</th>}
//                                         <th scope="col">Total</th>
//                                         <th scope="col">Actions</th>
//                                     </tr>
//                                     </thead>
//                                     <tbody>
//                                     {listeproducts.length === 0 ? (
//                                         <tr>
//                                             <td colSpan={isTvaActive && isRemiseActive ? 8 : 6} className="text-center">
//                                                 <h4 className="text-muted">Aucun produit disponible</h4>
//                                             </td>
//                                         </tr>
//                                     ) : (
//                                         listeproducts.map((pro, index) => {
//                                             const { pht, total } = calculateValues(pro, isTvaActive, isRemiseActive);
//
//                                             return (
//                                                 <tr key={index}>
//                                                     <td>{pro.code}</td>
//                                                     <td>{pro.name}</td>
//                                                     {isTvaActive && <td>{pro.tva}</td>}
//                                                     {isRemiseActive && <td>{pro.remise}</td>}
//                                                     <td>{pro.qte}</td>
//                                                     {isTvaActive && <td>{pht}</td>}
//                                                     <td>{pro.prixVente}</td>
//                                                     <td>{total}</td>
//                                                     <td>
//                                                         <button
//                                                             className="btn btn-sm btn-warning me-2"
//                                                             onClick={() => handleEdit(pro)}
//                                                         >
//                                                             <i className="fas fa-edit"></i> Modifier
//                                                         </button>
//                                                         <button
//                                                             className="btn btn-sm btn-danger"
//                                                             onClick={() => dispatch(deleteProduct(pro.id))}
//                                                         >
//                                                             <i className="fas fa-trash"></i> Supprimer
//                                                         </button>
//                                                     </td>
//                                                 </tr>
//                                             );
//                                         })
//                                     )}
//                                     </tbody>
//                                 </table>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     );
// };
//
// export default ListeProduits;

//
// import React, { useEffect } from 'react';
// import { useSelector, useDispatch } from 'react-redux';
// import { deleteProduct, updateTotalTTC } from "../../redux/crudActionSlice.js";
// import { calculateValues, calculateTotals } from "./Calcule.jsx";
// import { FaTrash, FaPen } from "react-icons/fa";
//
// const ListeProduits = ({ handleEdit }) => {
//     const dispatch = useDispatch();
//     const listeproducts = useSelector((state) => state.products.listeproducts);
//     const isTvaActive = useSelector((state) => state.activation.isTvaActive);
//     const isRemiseActive = useSelector((state) => state.activation.isRemiseActive);
//     const totalTTC = useSelector((state) => state.products.totalTTC);
//
//     // Calculer les totaux
//     const { totalHT, totalTVA, totalTTC: calculatedTotalTTC } = calculateTotals(
//         listeproducts,
//         isTvaActive,
//         isRemiseActive
//     );
//
//     // Mettre à jour totalTTC dans Redux après le rendu
//     useEffect(() => {
//         dispatch(updateTotalTTC(parseFloat(calculatedTotalTTC)));
//     }, [dispatch, calculatedTotalTTC]);
//
//     return (
//         <div className="container mt-4">
//             <div className="card shadow-sm">
//
//                 <div className="card-footer bg-light text-center">
//                     <strong>Total HT :</strong> <span className="text-danger">{totalHT}</span> &nbsp; | &nbsp;
//                     {isTvaActive && (<><strong>Total TVA :</strong> <span className="text-danger">{totalTVA} %</span> &nbsp; | &nbsp;</>)}
//                     <strong>Total TTC :</strong> <span className="text-danger">{totalTTC.toFixed(2)}</span>
//                 </div>
//
//                 <div className="card-body">
//                     <table className="table table-bordered text-center">
//                         <thead className="table-dark">
//                         <tr>
//                             <th>Référence</th>
//                             <th>Article</th>
//                             {isTvaActive && <th>TVA (%)</th>}
//                             {isRemiseActive && <th>Remise (%)</th>}
//                             <th>Quantité</th>
//                             {isTvaActive && <th>Prix HT</th>}
//                             <th>{isTvaActive ? "Prix TTC" : "Prix"}</th>
//                             <th>Total</th>
//                             <th>Actions</th>
//                         </tr>
//                         </thead>
//                         <tbody>
//                         {listeproducts.length === 0 ? (
//                             <tr>
//                                 <td colSpan={isTvaActive && isRemiseActive ? 8 : 6} className="text-muted">
//                                     Aucun produit disponible
//                                 </td>
//                             </tr>
//                         ) : (
//                             listeproducts.map((pro, index) => {
//                                 const { pht, total } = calculateValues(pro, isTvaActive, isRemiseActive);
//                                 return (
//                                     <tr key={index}>
//                                         <td>{pro.code}</td>
//                                         <td>{pro.name}</td>
//                                         {isTvaActive && <td>{pro.tva}</td>}
//                                         {isRemiseActive && <td>{pro.remise}</td>}
//                                         <td>{pro.qte}</td>
//                                         {isTvaActive && <td>{pht}</td>}
//                                         <td>{pro.prixVente}</td>
//                                         <td>{total}</td>
//                                         <td>
//                                             <button className="btn btn-warning btn-sm me-2" onClick={() => handleEdit(pro)}>
//                                                 <FaPen />
//                                             </button>
//                                             <button className="btn btn-danger btn-sm" onClick={() => dispatch(deleteProduct(pro.id))}>
//                                                 <FaTrash />
//                                             </button>
//                                         </td>
//                                     </tr>
//                                 );
//                             })
//                         )}
//                         </tbody>
//                     </table>
//                 </div>
//
//             </div>
//         </div>
//     );
// };
//
// export default ListeProduits;


import React, { useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { deleteProduct, updateTotalTTC } from "../../redux/crudActionSlice.js";
import { calculateValues, calculateTotals } from "./Calcule.jsx";
const ListeProduits = ({ handleEdit }) => {
    const dispatch = useDispatch();
    const listeproducts = useSelector((state) => state.products.listeproducts);
    const isTvaActive = useSelector((state) => state.activation.isTvaActive);
    const isRemiseActive = useSelector((state) => state.activation.isRemiseActive);
    const totalTTC = useSelector((state) => state.products.totalTTC);

    // Calculer les totaux
    const { totalHT, totalTVA, totalTTC: calculatedTotalTTC } = calculateTotals(
        listeproducts,
        isTvaActive,
        isRemiseActive
    );

    // Mettre à jour totalTTC dans Redux après le rendu
    useEffect(() => {
        dispatch(updateTotalTTC(parseFloat(calculatedTotalTTC)));
    }, [dispatch, calculatedTotalTTC]);

    return (
        <div className="container mt-4">
            <div className="card shadow-sm">
                <div className="card-header bg-info text-white">
                    <h5 className="card-title mb-0">Liste des produits</h5>
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col" style={{ color: "black" }}>
                            Totale HT : <span style={{ color: 'red' }}>{totalHT}</span>
                        </div>
                        {isTvaActive && (
                            <div className="col" style={{ color: "black" }}>
                                Totale TVA : <span style={{ color: 'red' }}>{totalTVA} %</span>
                            </div>
                        )}
                        <div className="col" style={{ color: "black" }}>
                            Totale TTC : <span style={{ color: 'red' }}>{totalTTC.toFixed(2)}</span>
                        </div>
                    </div>
                </div>
                <div className="card-body">
                    <div className="row">
                        <div className="col-12">
                            <div className="table-responsive">
                                <table className="table table-hover table-bordered w-100">
                                    <thead className="thead-dark">
                                    <tr>
                                        <th scope="col">Référence</th>
                                        <th scope="col">Article</th>
                                        {isTvaActive && <th scope="col">TVA (%)</th>}
                                        {isRemiseActive && <th scope="col">Remise (%)</th>}
                                        <th scope="col">Quantité</th>
                                        {isTvaActive && <th scope="col">Prix HT</th>}
                                        {isTvaActive ? <th scope="col">Prix TTC</th> : <th scope="col">Prix</th>}
                                        <th scope="col">Total</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {listeproducts.length === 0 ? (
                                        <tr>
                                            <td colSpan={isTvaActive && isRemiseActive ? 8 : 6} className="text-center">
                                                <h4 className="text-muted">Aucun produit disponible</h4>
                                            </td>
                                        </tr>
                                    ) : (
                                        listeproducts.map((pro, index) => {
                                            const { pht, total } = calculateValues(pro, isTvaActive, isRemiseActive);

                                            return (
                                                <tr key={index}>
                                                    <td>{pro.code}</td>
                                                    <td>{pro.name}</td>
                                                    {isTvaActive && <td>{pro.tva * 100}</td>}
                                                    {isRemiseActive && <td>{pro.remise}</td>}
                                                    <td>{pro.qte}</td>
                                                    {isTvaActive && <td>{pht}</td>}
                                                    <td>{pro.prixVente}</td>
                                                    <td>{total}</td>
                                                    <td>
                                                        <button
                                                            className="btn btn-sm btn-warning me-2"
                                                            onClick={() => handleEdit(pro)}
                                                        >
                                                            <i className="fas fa-edit"></i> Modifier
                                                        </button>
                                                        <button
                                                            className="btn btn-sm btn-danger"
                                                            onClick={() => dispatch(deleteProduct(pro.id))}
                                                        >
                                                            <i className="fas fa-trash"></i> Supprimer
                                                        </button>
                                                    </td>
                                                </tr>
                                            );
                                        })
                                    )}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ListeProduits;
