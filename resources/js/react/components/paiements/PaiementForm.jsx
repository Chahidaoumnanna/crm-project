import React, { useEffect, useState } from 'react';
import dayjs from 'dayjs';
import 'bootstrap/dist/css/bootstrap.min.css';
import { useDispatch, useSelector } from 'react-redux';
import { addPayment, editPayment, deletePayment, setPaymentDetails } from '@/react/redux/paiementSlice.js';
import { MdDelete } from 'react-icons/md';
import { CiEdit } from "react-icons/ci";

const PaiementForm = () => {
    const dispatch = useDispatch();
    const payments = useSelector((state) => state.payments.payments);
    const totalTTC = useSelector((state) => state.products.totalTTC);
    const { paymentMode, amount, dueDate, chequeOrEffet } = useSelector((state) => state.payments);
    const [editIndex, setEditIndex] = useState(null);

    useEffect(() => {
        dispatch(setPaymentDetails({ paymentMode, amount: totalTTC, dueDate, chequeOrEffet }));
    }, [totalTTC, dispatch]);

    const modesPaiement = [
        { id: 1, name: 'Crédit' },
        { id: 2, name: 'Espece' },
        { id: 3, name: 'Cheque' },
        { id: 4, name: 'Effet de commerce' },
        { id: 5, name: 'Virement' },
    ];

    const handleInputChange = (field, value) => {
        dispatch(setPaymentDetails({
            paymentMode,
            amount,
            dueDate,
            chequeOrEffet,
            [field]: value
        }));
    };

    const handleButtonClick = () => {
        const newPayment = { paymentMode, amount: parseFloat(amount), dueDate, chequeOrEffet };
        if (editIndex !== null) {
            dispatch(editPayment({ index: editIndex, payment: newPayment }));
            setEditIndex(null);
        } else {
            dispatch(addPayment(newPayment));
        }
        dispatch(setPaymentDetails({ paymentMode: 'Crédit', amount: totalTTC, dueDate: dayjs().format('YYYY-MM-DD'), chequeOrEffet: '' }));
    };

    return (
        <div className="container mt-5">
            <h2 className="text-muted">Paiement :</h2>
            <h4 className="text-muted">Total TTC à payer : {totalTTC} DH</h4>
            <div className="d-flex">
                <div style={{ width: '30%' }} className="p-4 shadow">
                    <div className="mb-3">
                        <label className="form-label">Mode paiement:</label>
                        <select className="form-select" value={paymentMode} onChange={(e) => handleInputChange('paymentMode', e.target.value)}>
                            {modesPaiement.map((mode) => (
                                <option key={mode.id} value={mode.name}>{mode.name}</option>
                            ))}
                        </select>
                    </div>
                    <div className="mb-3">
                        <label className="form-label">Montant:</label>
                        <input type="number" className="form-control" value={amount} onChange={(e) => handleInputChange('amount', e.target.value)} />
                    </div>
                    <div className="mb-3">
                        <label className="form-label">Échéance:</label>
                        <input type="date" className="form-control" value={dueDate} onChange={(e) => handleInputChange('dueDate', e.target.value)} />
                    </div>
                    {(paymentMode === 'Cheque' || paymentMode === 'Effet de commerce') && (
                        <div className="mb-3">
                            <label className="form-label">N° Chèque ou Effet:</label>
                            <input type="text" className="form-control" value={chequeOrEffet} onChange={(e) => handleInputChange('chequeOrEffet', e.target.value)} />
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
                                <th>Mode de paiement</th>
                                <th>Montant</th>
                                <th>Échéance</th>
                                <th>N° Chèque ou Effet</th>
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
                                        <button className="btn btn-warning me-2" onClick={() => {
                                            dispatch(setPaymentDetails(payment));
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
                )}
            </div>
        </div>
    );
};

export default PaiementForm;
