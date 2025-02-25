//
//
// import React, { useState } from 'react';
// import dayjs from 'dayjs';
// import 'bootstrap/dist/css/bootstrap.min.css';
// import { useDispatch, useSelector } from 'react-redux';
// import {addPayment ,editPayment, deletePayment} from '../../redux/paiementSlice.js'
// import { MdDelete } from 'react-icons/md';
// import { CiEdit } from "react-icons/ci";
//
// const PaiementForm = () => {
//     const dispatch = useDispatch();
//     const payments = useSelector((state) => state.payments.payments);
//     const totalTTC = useSelector((state) => state.products.totalTTC); // Récupération de totalTTC depuis Redux
//
//     const [paymentMode, setPaymentMode] = useState('Crédit');
//     const [amount, setAmount] = useState(totalTTC); // Définir le montant initial sur totalTTC
//     const [dueDate, setDueDate] = useState(dayjs().format('YYYY-MM-DD'));
//     const [chequeOrEffet, setChequeOrEffet] = useState('');
//     const [editIndex, setEditIndex] = useState(null);
//
//     const modesPaiement = [
//         { id: 1, name: 'Crédit' },
//         { id: 2, name: 'Espèce' },
//         { id: 3, name: 'Chèque' },
//         { id: 4, name: 'Effet de commerce' },
//         { id: 5, name: 'Virement' },
//     ];
//
//     const handlePaymentModeChange = (event) => {
//         setPaymentMode(event.target.value);
//         setChequeOrEffet('');
//     };
//
//     const handleAmountChange = (event) => {
//         setAmount(parseFloat(event.target.value));
//     };
//
//     const handleDueDateChange = (event) => {
//         setDueDate(event.target.value);
//     };
//
//     const handleChequeOrEffetChange = (event) => {
//         setChequeOrEffet(event.target.value);
//     };
//
//     const handleButtonClick = () => {
//         if (amount <= 0) {
//             alert("Le montant doit être supérieur à zéro.");
//             return;
//         }
//
//         const newPayment = {
//             paymentMode,
//             amount: parseFloat(amount),
//             dueDate,
//             chequeOrEffet,
//         };
//
//         if (editIndex !== null) {
//             dispatch(editPayment({ index: editIndex, payment: newPayment }));
//             setEditIndex(null);
//         } else {
//             dispatch(addPayment(newPayment));
//         }
//
//         setAmount(totalTTC); // Réinitialiser à totalTTC après ajout
//         setDueDate(dayjs().format('YYYY-MM-DD'));
//         setChequeOrEffet('');
//     };
//
//     const handleDeletePayment = (index) => {
//         dispatch(deletePayment(index));
//     };
//
//     const handleEditPayment = (index) => {
//         const paymentToEdit = payments[index];
//         setPaymentMode(paymentToEdit.paymentMode);
//         setAmount(paymentToEdit.amount);
//         setDueDate(paymentToEdit.dueDate);
//         setChequeOrEffet(paymentToEdit.chequeOrEffet);
//         setEditIndex(index);
//     };
//
//     return (
//         <div className="container mt-5">
//             <h2 className="text-muted">Paiement :</h2>
//             <div className="d-flex">
//                 <div style={{ width: '30%' }} className="p-4 shadow">
//                     <div className="mb-3">
//                         <label htmlFor="paymentMode" className="form-label">Mode paiement:</label>
//                         <select id="paymentMode" className="form-select" value={paymentMode} onChange={handlePaymentModeChange}>
//                             {modesPaiement.map((mode) => (
//                                 <option key={mode.id} value={mode.name}>
//                                     {mode.name}
//                                 </option>
//                             ))}
//                         </select>
//                     </div>
//
//                     <div className="mb-3">
//                         <label htmlFor="amount" className="form-label">Montant :</label>
//                         <input
//                             type="number"
//                             id="amount"
//                             className="form-control"
//                             value={totalTTC}
//                             onChange={handleAmountChange}
//                         />
//                     </div>
//
//                     <div className="mb-3">
//                         <label htmlFor="dueDate" className="form-label">Échéance:</label>
//                         <input
//                             type="date"
//                             id="dueDate"
//                             className="form-control"
//                             value={dueDate}
//                             onChange={handleDueDateChange}
//                         />
//                     </div>
//
//                     {(paymentMode === 'Chèque' || paymentMode === 'Effet de commerce') && (
//                         <div className="mb-3">
//                             <label htmlFor="chequeOrEffet" className="form-label">N° Chèque ou Effet:</label>
//                             <input
//                                 type="text"
//                                 id="chequeOrEffet"
//                                 className="form-control"
//                                 value={chequeOrEffet}
//                                 onChange={handleChequeOrEffetChange}
//                             />
//                         </div>
//                     )}
//
//                     <button className="btn btn-success" onClick={handleButtonClick}>
//                         {editIndex !== null ? 'Modifier le paiement' : 'Ajouter le paiement'}
//                     </button>
//                 </div>
//
//                 {payments.length > 0 && (
//                     <div style={{ width: '70%' }} className="p-4">
//                         <h3 className="text-center text-muted">Liste des paiements:</h3>
//                         <table className="table table-striped table-bordered">
//                             <thead className="table-dark">
//                             <tr>
//                                 <th>Mode</th>
//                                 <th>Montant</th>
//                                 <th>Échéance</th>
//                                 <th>N° Chèque ou Effet</th>
//                                 <th>Actions</th>
//                             </tr>
//                             </thead>
//                             <tbody>
//                             {payments.map((payment, index) => (
//                                 <tr key={index}>
//                                     <td>{payment.paymentMode}</td>
//                                     <td>{payment.amount}</td>
//                                     <td>{payment.dueDate}</td>
//                                     <td>{payment.chequeOrEffet}</td>
//                                     <td>
//                                         <button className="btn btn-warning me-2" onClick={() => handleEditPayment(index)}><CiEdit /></button>
//                                         <button className="btn btn-danger" onDoubleClick={() => handleDeletePayment(index)}><MdDelete /></button>
//                                     </td>
//                                 </tr>
//                             ))}
//                             </tbody>
//                         </table>
//                     </div>
//                 )}
//             </div>
//         </div>
//     );
// };
//
// export default PaiementForm;
//




import React, { useState } from 'react';
import dayjs from 'dayjs';
import 'bootstrap/dist/css/bootstrap.min.css';
import { useDispatch, useSelector } from 'react-redux';
import {addPayment ,editPayment, deletePayment} from '../../redux/paiementSlice.js'
import { MdDelete } from 'react-icons/md';
import { CiEdit } from "react-icons/ci";

const PaiementForm = () => {
    const dispatch = useDispatch();
    const payments = useSelector((state) => state.payments.payments);
    const totalTTC = useSelector((state) => state.products.totalTTC); // Récupération de totalTTC depuis Redux

    const [paymentMode, setPaymentMode] = useState('Crédit');
    const [amount, setAmount] = useState(totalTTC); // Définir le montant initial sur totalTTC
    const [dueDate, setDueDate] = useState(dayjs().format('YYYY-MM-DD'));
    const [chequeOrEffet, setChequeOrEffet] = useState('');
    const [editIndex, setEditIndex] = useState(null);

    const modesPaiement = [
        { id: 1, name: 'Crédit' },
        { id: 2, name: 'Espèce' },
        { id: 3, name: 'Chèque' },
        { id: 4, name: 'Effet de commerce' },
        { id: 5, name: 'Virement' },
    ];

    const handlePaymentModeChange = (event) => {
        setPaymentMode(event.target.value);
        setChequeOrEffet('');
    };

    const handleAmountChange = (event) => {
        setAmount(parseFloat(event.target.value));
    };

    const handleDueDateChange = (event) => {
        setDueDate(event.target.value);
    };

    const handleChequeOrEffetChange = (event) => {
        setChequeOrEffet(event.target.value);
    };

    const handleButtonClick = () => {
        if (amount <= 0) {
            alert("Le montant doit être supérieur à zéro.");
            return;
        }

        const newPayment = {
            paymentMode,
            amount: parseFloat(amount),
            dueDate,
            chequeOrEffet,
        };

        if (editIndex !== null) {
            dispatch(editPayment({ index: editIndex, payment: newPayment }));
            setEditIndex(null);
        } else {
            dispatch(addPayment(newPayment));
        }

        setAmount(totalTTC); // Réinitialiser à totalTTC après ajout
        setDueDate(dayjs().format('YYYY-MM-DD'));
        setChequeOrEffet('');
    };

    const handleDeletePayment = (index) => {
        dispatch(deletePayment(index));
    };

    const handleEditPayment = (index) => {
        const paymentToEdit = payments[index];
        setPaymentMode(paymentToEdit.paymentMode);
        setAmount(paymentToEdit.amount);
        setDueDate(paymentToEdit.dueDate);
        setChequeOrEffet(paymentToEdit.chequeOrEffet);
        setEditIndex(index);
    };

    return (
        <div className="container mt-5">
            <h2 className="text-muted">Paiement :</h2>
            <div className="d-flex">
                <div style={{ width: '30%' }} className="p-4 shadow">
                    <div className="mb-3">
                        <label htmlFor="paymentMode" className="form-label">Mode paiement:</label>
                        <select id="paymentMode" className="form-select" value={paymentMode} onChange={handlePaymentModeChange}>
                            {modesPaiement.map((mode) => (
                                <option key={mode.id} value={mode.name}>
                                    {mode.name}
                                </option>
                            ))}
                        </select>
                    </div>

                    <div className="mb-3">
                        <label htmlFor="amount" className="form-label">Montant :</label>
                        <input
                            type="number"
                            id="amount"
                            className="form-control"
                            value={totalTTC}
                            onChange={handleAmountChange}
                        />
                    </div>

                    <div className="mb-3">
                        <label htmlFor="dueDate" className="form-label">Échéance:</label>
                        <input
                            type="date"
                            id="dueDate"
                            className="form-control"
                            value={dueDate}
                            onChange={handleDueDateChange}
                        />
                    </div>

                    {(paymentMode === 'Chèque' || paymentMode === 'Effet de commerce') && (
                        <div className="mb-3">
                            <label htmlFor="chequeOrEffet" className="form-label">N° Chèque ou Effet:</label>
                            <input
                                type="text"
                                id="chequeOrEffet"
                                className="form-control"
                                value={chequeOrEffet}
                                onChange={handleChequeOrEffetChange}
                            />
                        </div>
                    )}

                    <button className="btn btn-success" onClick={handleButtonClick}>
                        {editIndex !== null ? 'Modifier le paiement' : 'Ajouter le paiement'}
                    </button>
                </div>

                {payments.length > 0 && (
                    <div style={{ width: '70%' }} className="p-4">
                        <h3 className="text-center text-muted">Liste des paiements:</h3>
                        <table className="table table-striped table-bordered">
                            <thead className="table-dark">
                            <tr>
                                <th>Mode</th>
                                <th>Montant</th>
                                <th>Échéance</th>
                                <th>N° Chèque ou Effet</th>
                                <th>Actions</th>
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
                                        <button className="btn btn-warning me-2" onClick={() => handleEditPayment(index)}><CiEdit /></button>
                                        <button className="btn btn-danger" onDoubleClick={() => handleDeletePayment(index)}><MdDelete /></button>
                                    </td>
                                </tr>
                            ))}
                            </tbody>
                        </table>
                    </div>
                )}
            </div>
        </div>
    );
};

export default PaiementForm;

