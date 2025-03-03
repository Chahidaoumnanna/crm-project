// import React, { useState, useEffect } from 'react';
// import dayjs from 'dayjs';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import 'bootstrap/dist/js/bootstrap.bundle.min.js';
// import { useDispatch, useSelector } from 'react-redux';
// import { addPayment, editPayment, deletePayment } from '../../redux/paiementSlice.js';
// import { MdDelete } from 'react-icons/md';
// import { CiEdit } from 'react-icons/ci';
//
// const PaiementForm = () => {
//     const dispatch = useDispatch();
//     const payments = useSelector((state) => state.payments.payments);
//     const totalTTC = useSelector((state) => parseFloat(state.products.totalTTC) || 0); // S'assurer que c'est un nombre
//
//     const [paymentMode, setPaymentMode] = useState('Crédit');
//     const [amount, setAmount] = useState(totalTTC.toFixed(2));
//     const [dueDate, setDueDate] = useState(dayjs().format('YYYY-MM-DD'));
//     const [chequeOrEffet, setChequeOrEffet] = useState('');
//     const [editIndex, setEditIndex] = useState(null);
//     const [alertMessage, setAlertMessage] = useState('');
//     const [showAlert, setShowAlert] = useState(false);
//
//     const totalPaid = payments.reduce((sum, payment) => sum + (parseFloat(payment.amount) || 0), 0);
//     const remainingTotal = Math.max(totalTTC - totalPaid, 0);
//
//     useEffect(() => {
//         setAmount(remainingTotal.toString());
//     }, [totalTTC, totalPaid]);
//
//     const modesPaiement = ['Crédit', 'Espèce', 'Chèque', 'Effet de commerce', 'Virement'];
//
//     const handlePaymentModeChange = (event) => {
//         setPaymentMode(event.target.value);
//         setChequeOrEffet('');
//     };
//
//     const handleButtonClick = () => {
//         if (remainingTotal <= 0) {
//             showToast("Vous ne pouvez plus ajouter de paiements, le total TTC est déjà payé !");
//             return;
//         }
//
//         const paymentAmount = parseFloat(amount);
//
//         if (isNaN(paymentAmount) || paymentAmount <= 0) {
//             showToast('Veuillez entrer un montant valide.');
//             return;
//         }
//
//         if (paymentAmount > remainingTotal) {
//             showToast('Le montant du paiement ne peut pas dépasser le total restant.');
//             return;
//         }
//
//         const newPayment = { paymentMode, amount: paymentAmount, dueDate, chequeOrEffet };
//
//         if (editIndex !== null) {
//             dispatch(editPayment({ index: editIndex, payment: newPayment }));
//             setEditIndex(null);
//         } else {
//             dispatch(addPayment(newPayment));
//         }
//
//         setAmount(remainingTotal.toString());
//         setDueDate(dayjs().format('YYYY-MM-DD'));
//         setChequeOrEffet('');
//     };
//
//     const showToast = (message) => {
//         setAlertMessage(message);
//         setShowAlert(true);
//         setTimeout(() => setShowAlert(false), 3000);
//     };
//
//     return (
//         <div className="container mt-4">
//             {showAlert && (
//                 <div className="position-fixed top-0 end-0 p-3" style={{ zIndex: 1050 }}>
//                     <div className="toast show text-white bg-danger small p-2">{alertMessage}</div>
//                 </div>
//             )}
//
//             <div className="text-center mb-4">
//                 <div className="d-flex justify-content-center gap-4 mt-2">
//                     <h5>Paiements :</h5>
//                     <h5 className="badge bg-secondary p-3">💰 Total TTC : <span className="fw-bold">{totalTTC.toFixed(2)} DH</span></h5>
//                     <h5 className={`badge p-3 ${remainingTotal > 0 ? "bg-success" : "bg-danger"}`}>
//                         🔻 Restant : <span className="fw-bold">{remainingTotal.toFixed(2)} DH</span>
//                     </h5>
//                 </div>
//             </div>
//
//             <div className="row">
//                 <div className="col-md-3 p-4 shadow rounded bg-light">
//                     <h4 className="text-muted">Ajouter un Paiement</h4>
//
//                     <div className="mb-3">
//                         <label className="form-label">Mode de paiement</label>
//                         <select className="form-select" value={paymentMode} onChange={handlePaymentModeChange}>
//                             {modesPaiement.map((mode, index) => (
//                                 <option key={index} value={mode}>{mode}</option>
//                             ))}
//                         </select>
//                     </div>
//
//                     <div className="mb-3">
//                         <label className="form-label">Montant</label>
//                         <input
//                             type="number"
//                             className="form-control"
//                             value={amount}
//                             onChange={(e) => setAmount(e.target.value)}
//                             min="0"
//                             max={remainingTotal || "0"} // Évite d'avoir un NaN
//                         />
//                     </div>
//
//                     <div className="mb-3">
//                         <label className="form-label">Échéance</label>
//                         <input type="date" className="form-control" value={dueDate} onChange={(e) => setDueDate(e.target.value)} />
//                     </div>
//
//                     {(paymentMode === 'Chèque' || paymentMode === 'Effet de commerce') && (
//                         <div className="mb-3">
//                             <label className="form-label">N° Chèque ou Effet</label>
//                             <input type="text" className="form-control" value={chequeOrEffet} onChange={(e) => setChequeOrEffet(e.target.value)} />
//                         </div>
//                     )}
//
//                     <button className="btn btn-primary w-100" onClick={handleButtonClick}>
//                         {editIndex !== null ? 'Modifier le paiement' : 'Ajouter le paiement'}
//                     </button>
//                 </div>
//
//                 <div className="col-md-9 p-4">
//                     <h3 className="text-center text-muted">Liste des paiements</h3>
//                     <table className="table table-striped table-bordered">
//                         <thead className="table-dark">
//                         <tr>
//                             <th>Mode de paiement</th>
//                             <th>Montant</th>
//                             <th>Échéance</th>
//                             <th>N° Chèque ou Effet</th>
//                             <th>Actions</th>
//                         </tr>
//                         </thead>
//                         <tbody>
//                         {payments.map((payment, index) => (
//                             <tr key={index}>
//                                 <td>{payment.paymentMode}</td>
//                                 <td>{payment.amount}</td>
//                                 <td>{payment.dueDate}</td>
//                                 <td>{payment.chequeOrEffet}</td>
//                                 <td>
//                                     <button className="btn btn-warning me-2" onClick={() => {
//                                         setPaymentMode(payment.paymentMode);
//                                         setAmount(payment.amount.toString());
//                                         setDueDate(payment.dueDate);
//                                         setChequeOrEffet(payment.chequeOrEffet);
//                                         setEditIndex(index);
//                                     }}>
//                                         <CiEdit />
//                                     </button>
//                                     <button className="btn btn-danger" onDoubleClick={() => dispatch(deletePayment(index))}>
//                                         <MdDelete />
//                                     </button>
//                                 </td>
//                             </tr>
//                         ))}
//                         </tbody>
//                     </table>
//                 </div>
//             </div>
//         </div>
//     );
// };
//
// export default PaiementForm;


import React, { useState, useEffect } from 'react';
import dayjs from 'dayjs';
import 'bootstrap/dist/css/bootstrap.min.css';
import { useDispatch, useSelector } from 'react-redux';
import { addPayment, editPayment, deletePayment } from '../../redux/paiementSlice.js';
import { MdDelete } from 'react-icons/md';
import { CiEdit } from 'react-icons/ci';

const PaiementForm = () => {
    const dispatch = useDispatch();
    const payments = useSelector((state) => state.payments.payments);
    const totalTTC = useSelector((state) => parseFloat(state.products.totalTTC) || 0);

    const [paymentMode, setPaymentMode] = useState('Crédit');
    const [amount, setAmount] = useState(totalTTC.toFixed(2));
    const [dueDate, setDueDate] = useState(dayjs().format('YYYY-MM-DD'));
    const [chequeOrEffet, setChequeOrEffet] = useState('');
    const [editIndex, setEditIndex] = useState(null);
    const [alertMessage, setAlertMessage] = useState('');
    const [showAlert, setShowAlert] = useState(false);

    const totalPaid = payments.reduce((sum, payment) => sum + (parseFloat(payment.amount) || 0), 0);
    const remainingTotal = Math.max(totalTTC - totalPaid, 0);

    useEffect(() => {
        setAmount(remainingTotal.toString());
    }, [totalTTC, totalPaid]);

    const modesPaiement = ['Crédit', 'Espèce', 'Chèque', 'Effet de commerce', 'Virement'];

    const handleButtonClick = () => {
        if (remainingTotal <= 0) {
            showToast("Le total TTC est déjà payé !");
            return;
        }

        const paymentAmount = parseFloat(amount);
        if (isNaN(paymentAmount) || paymentAmount <= 0) {
            showToast('Veuillez entrer un montant valide.');
            return;
        }

        if (paymentAmount > remainingTotal) {
            showToast('Le montant du paiement ne peut pas dépasser le total restant.');
            return;
        }

        const newPayment = { paymentMode, amount: paymentAmount, dueDate, chequeOrEffet };

        if (editIndex !== null) {
            dispatch(editPayment({ index: editIndex, payment: newPayment }));
            setEditIndex(null);
        } else {
            dispatch(addPayment(newPayment));
        }

        setAmount(remainingTotal.toString());
        setDueDate(dayjs().format('YYYY-MM-DD'));
        setChequeOrEffet('');
    };

    const showToast = (message) => {
        setAlertMessage(message);
        setShowAlert(true);
        setTimeout(() => setShowAlert(false), 3000);
    };

    return (
        <div className="container mt-4">
            {showAlert && (
                <div className="position-fixed top-0 end-0 p-3" style={{ zIndex: 1050 }}>
                    <div className="toast show text-white bg-danger small p-2">{alertMessage}</div>
                </div>
            )}
            <h5 className="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                <span className='mb-0'>Paiements :</span>
                <div className="d-flex align-items-center gap-3 p-2 rounded shadow-sm"
                     style={{ backgroundColor: '#f8f9fa', border: '1px solid #ddd' }}>
                    <div>
                        <span className="fw-semibold text-muted me-2 fs-sm">Total TTC:</span>
                        <span className="px-2 py-1 rounded text-white"
                              style={{ backgroundColor: '#88bde4', fontWeight: 'bold', fontSize: '0.875rem' }}>
                {totalTTC.toFixed(2)} DH
            </span>
                    </div>

                    <div>
                        <span className="fw-semibold text-muted me-2 fs-sm">Total Restant:</span>
                        <span className="px-2 py-1 rounded text-white"
                              style={{ backgroundColor: remainingTotal > 0 ? '#28a745' : '#dc3545', fontWeight: 'bold', fontSize: '0.875rem' }}>
                {remainingTotal.toFixed(2)} DH
            </span>
                    </div>
                </div>
            </h5>



            <div className="row">
                    <div className="col-md-3 p-4 shadow rounded bg-light">

                        <div className="mb-3">
                            <label className="form-label">Mode de paiement</label>
                            <select className="form-select" value={paymentMode} onChange={(e) => setPaymentMode(e.target.value)}>
                                {modesPaiement.map((mode, index) => (
                                    <option key={index} value={mode}>{mode}</option>
                                ))}
                            </select>
                        </div>

                        <div className="mb-3">
                            <label className="form-label">Montant</label>
                            <input
                                type="number"
                                className="form-control"
                                value={amount}
                                onChange={(e) => setAmount(e.target.value)}
                                min="0"
                                max={remainingTotal || "0"}
                            />
                        </div>
                        <div className="mb-3">
                            <label className="form-label">Échéance</label>
                            <input type="date" className="form-control" value={dueDate} onChange={(e) => setDueDate(e.target.value)} />
                        </div>

                        {(paymentMode === 'Chèque' || paymentMode === 'Effet de commerce') && (
                            <div className="mb-3">
                                <label className="form-label">N° Chèque ou Effet</label>
                                <input type="text" className="form-control" value={chequeOrEffet} onChange={(e) => setChequeOrEffet(e.target.value)} />
                            </div>
                        )}

                        <button className="btn w-90" onClick={handleButtonClick} style={{backgroundColor: '#88bde4' , color:'white'}}>
                            {editIndex !== null ? 'Modifier le paiement' : 'Ajouter le paiement'}
                        </button>
                    </div>

                    <div className="col-md-9 p-4">
                        <h3 className="text-center text-muted">
                            <span style={{ color: '#003366' }}>Liste </span>
                            <span style={{ color: '#88bde4' }}>des </span>
                            <span style={{ color: '#003366' }}>paiements </span>
                        </h3>

                        <table className="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th  style={{ backgroundColor: '#003366', color: 'white' }}>Mode de paiement</th>
                                <th  style={{ backgroundColor: '#003366', color: 'white' }}>Montant</th>
                                <th  style={{ backgroundColor: '#003366', color: 'white' }}>Échéance</th>
                                <th  style={{ backgroundColor: '#003366', color: 'white' }}>N° Chèque ou Effet</th>
                                <th  style={{ backgroundColor: '#003366', color: 'white' }}>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            {payments.map((payment, index) => (
                                <tr key={index}>
                                    <td>{payment.paymentMode}</td>
                                    <td>{payment.amount}</td>
                                    <td>{payment.dueDate}</td>
                                    <td>{payment.chequeOrEffet}</td>
                                    <td>
                                        <button className="btn btn-warning me-2" onClick={() => {
                                            setPaymentMode(payment.paymentMode);
                                            setAmount(payment.amount.toString());
                                            setDueDate(payment.dueDate);
                                            setChequeOrEffet(payment.chequeOrEffet);
                                            setEditIndex(index);
                                        }}>
                                            <CiEdit />
                                        </button>
                                        <button className="btn btn-danger" onDoubleClick={() => dispatch(deletePayment(index))}>
                                            <MdDelete />
                                        </button>
                                    </td>
                                </tr>
                            ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    );
};

export default PaiementForm;

