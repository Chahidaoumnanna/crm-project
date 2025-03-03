//
//
// import React, { useEffect } from 'react';
// import { useSelector, useDispatch } from 'react-redux';
// import { Table, Button, Badge } from 'react-bootstrap';
// import { deleteProduct, updateTotalTTC } from "../../redux/crudActionSlice.js";
// import { calculateValues, calculateTotals } from "./Calcule.jsx";
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
//         <div className="mb-4">
//             <div className="bg-white p-3 rounded">
//                 <div className="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
//                     <h5 className="mb-0">Liste des produits :</h5>
//                     <div className="d-flex align-items-center gap-4 p-3 rounded shadow-sm"
//                          style={{ backgroundColor: '#f8f9fa', border: '1px solid #ddd' }}>
//
//                         <div>
//                             <span className="fw-semibold text-muted me-2">Total HT:</span>
//                             <span className="px-3 py-1 rounded text-white"
//                                   style={{ backgroundColor: '#88bde4', fontWeight: 'bold' }}>
//             {totalHT}
//         </span>
//                         </div>
//
//                         {isTvaActive && (
//                             <div>
//                                 <span className="fw-semibold text-muted me-2">Total TVA:</span>
//                                 <span className="px-3 py-1 rounded text-white"
//                                       style={{ backgroundColor: '#88bde4', fontWeight: 'bold' }}>
//                 {totalTVA} %
//             </span>
//                             </div>
//                         )}
//
//                         <div>
//                             <span className="fw-semibold text-muted me-2">Total TTC:</span>
//                             <span className="px-3 py-1 rounded text-white"
//                                   style={{ backgroundColor: '#88bde4' ,color:'red'}}>
//             {totalTTC.toFixed(2)}
//         </span>
//                         </div>
//                     </div>
//
//                 </div>
//
//                 <Table responsive hover bordered className="mb-0">
//                     <thead className="thead-light">
//                     <tr >
//                         <th style={{ backgroundColor: '#003366', color: 'white' }}>Référence</th>
//                         <th style={{ backgroundColor: '#003366', color: 'white' }}>Article</th>
//                         {isTvaActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>TVA (%)</th>}
//                         {isRemiseActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>Remise (%)</th>}
//                         <th style={{ backgroundColor: '#003366', color: 'white' }}>Quantité</th>
//                         {isTvaActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>Prix HT</th>}
//                         <th style={{ backgroundColor: '#003366', color: 'white' }}>{isTvaActive ? "Prix TTC" : "Prix"}</th>
//                         <th style={{ backgroundColor: '#003366', color: 'white' }}>Total</th>
//                         <th style={{ backgroundColor: '#003366', color: 'white' }}>Actions</th>
//                     </tr>
//                     </thead>
//                     <tbody>
//                     {listeproducts.length === 0 ? (
//                         <tr>
//                             <td colSpan={isTvaActive && isRemiseActive ? 9 : (isTvaActive || isRemiseActive ? 8 : 7)} className="text-center py-4">
//                                 <p className="text-muted mb-0">Aucun produit disponible</p>
//                             </td>
//                         </tr>
//                     ) : (
//                         listeproducts.map((pro, index) => {
//                             const { pht, total } = calculateValues(pro, isTvaActive, isRemiseActive);
//
//                             return (
//                                 <tr key={index}>
//                                     <td>{pro.code}</td>
//                                     <td>{pro.name}</td>
//                                     {isTvaActive && <td>{pro.tva}</td>}
//                                     {isRemiseActive && <td>{pro.remise}</td>}
//                                     <td>{pro.qte}</td>
//                                     {isTvaActive && <td>{pht}</td>}
//                                     <td>{pro.prixVente}</td>
//                                     <td>{total}</td>
//                                     <td>
//                                         <Button
//                                             variant="outline-warning"
//                                             size="sm"
//                                             className="me-2"
//                                             onClick={() => handleEdit(pro)}
//                                         >
//                                             Modifier
//                                         </Button>
//                                         <Button
//                                             variant="outline-danger"
//                                             size="sm"
//                                             onClick={() => dispatch(deleteProduct(pro.id))}
//                                         >
//                                             Supprimer
//                                         </Button>
//                                     </td>
//                                 </tr>
//                             );
//                         })
//                     )}
//                     </tbody>
//                 </Table>
//             </div>
//         </div>
//     );
// };
//
// export default ListeProduits;



import React, { useEffect, useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Table } from 'react-bootstrap';
import { FaEdit, FaTrash, FaArrowUp, FaArrowDown } from 'react-icons/fa';
import { deleteProduct, updateTotalTTC, moveProductUp, moveProductDown } from "../../redux/crudActionSlice.js";
import { calculateValues, calculateTotals } from "./Calcule.jsx";

const ListeProduits = ({ handleEdit }) => {
    const dispatch = useDispatch();
    const listeproducts = useSelector((state) => state.products.listeproducts);
    const isTvaActive = useSelector((state) => state.activation.isTvaActive);
    const isRemiseActive = useSelector((state) => state.activation.isRemiseActive);
    const totalTTC = useSelector((state) => state.products.totalTTC);

    const [hoveredRow, setHoveredRow] = useState(null);

    // Calculer les totaux
    const { totalHT, totalTVA, totalTTC: calculatedTotalTTC } = calculateTotals(
        listeproducts, isTvaActive, isRemiseActive
    );

    // Mettre à jour totalTTC dans Redux après le rendu
    useEffect(() => {
        dispatch(updateTotalTTC(parseFloat(calculatedTotalTTC)));
    }, [dispatch, calculatedTotalTTC]);

    return (
        <div className="mb-4">
            <div className="bg-white p-3 rounded shadow-sm">
                <div className="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <h5 className="mb-0">Liste des produits :</h5>
                    <div className="d-flex align-items-center gap-4 p-3 rounded shadow-sm"
                         style={{ backgroundColor: '#f8f9fa', border: '1px solid #ddd' }}>
                        <div>
                            <span className="fw-semibold text-muted me-2">Total HT:</span>
                            <span className="px-3 py-1 rounded text-white"
                                  style={{ backgroundColor: '#88bde4', fontWeight: 'bold' }}>
                                {totalHT}
                            </span>
                        </div>

                        {isTvaActive && (
                            <div>
                                <span className="fw-semibold text-muted me-2">Total TVA:</span>
                                <span className="px-3 py-1 rounded text-white"
                                      style={{ backgroundColor: '#88bde4', fontWeight: 'bold' }}>
                                    {totalTVA} %
                                </span>
                            </div>
                        )}

                        <div>
                            <span className="fw-semibold text-muted me-2">Total TTC:</span>
                            <span className="px-3 py-1 rounded text-white"
                                  style={{ backgroundColor: '#88bde4', color: 'red' }}>
                                {totalTTC.toFixed(2)}
                            </span>
                        </div>
                    </div>
                </div>

                <Table responsive hover bordered className="mb-0">
                    <thead className="thead-light">
                    <tr>
                        <th style={{ backgroundColor: '#003366', color: 'white' }}>Référence</th>
                        <th style={{ backgroundColor: '#003366', color: 'white' }}>Article</th>
                        {isTvaActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>TVA (%)</th>}
                        {isRemiseActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>Remise (%)</th>}
                        <th style={{ backgroundColor: '#003366', color: 'white' }}>Quantité</th>
                        {isTvaActive && <th style={{ backgroundColor: '#003366', color: 'white' }}>Prix HT</th>}
                        <th style={{ backgroundColor: '#003366', color: 'white' }}>{isTvaActive ? "Prix TTC" : "Prix"}</th>
                        <th style={{ backgroundColor: '#003366', color: 'white' }}>Total</th>
                        <th style={{ backgroundColor: '#003366', color: 'white' }}>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {listeproducts.length === 0 ? (
                        <tr>
                            <td colSpan={isTvaActive && isRemiseActive ? 9 : (isTvaActive || isRemiseActive ? 8 : 7)}
                                className="text-center py-4">
                                <p className="text-muted mb-0">Aucun produit disponible</p>
                            </td>
                        </tr>
                    ) : (
                        listeproducts.map((pro, index) => {
                            const { pht, total } = calculateValues(pro, isTvaActive, isRemiseActive);

                            return (
                                <tr key={index}
                                    onMouseEnter={() => setHoveredRow(index)}
                                    onMouseLeave={() => setHoveredRow(null)}
                                >
                                    <td>{pro.code}</td>
                                    <td>{pro.name}</td>
                                    {isTvaActive && <td>{pro.tva}</td>}
                                    {isRemiseActive && <td>{pro.remise}</td>}
                                    <td>{pro.qte}</td>
                                    {isTvaActive && <td>{pht}</td>}
                                    <td>{pro.prixVente}</td>
                                    <td>{total}</td>
                                    <td>
                                        {hoveredRow === index && (
                                            <div className="d-flex gap-2">
                                                <FaArrowUp
                                                    className="text-primary cursor-pointer"
                                                    onClick={() => dispatch(moveProductUp(index))}
                                                />
                                                <FaArrowDown
                                                    className="text-primary cursor-pointer"
                                                    onClick={() => dispatch(moveProductDown(index))}
                                                />
                                                <FaEdit
                                                    className="text-warning cursor-pointer"
                                                    onClick={() => handleEdit(pro)}
                                                />
                                                <FaTrash
                                                    className="text-danger cursor-pointer"
                                                    onClick={() => dispatch(deleteProduct(pro.id))}
                                                />
                                            </div>
                                        )}
                                    </td>
                                </tr>
                            );
                        })
                    )}
                    </tbody>
                </Table>
            </div>
        </div>
    );
};

export default ListeProduits;

