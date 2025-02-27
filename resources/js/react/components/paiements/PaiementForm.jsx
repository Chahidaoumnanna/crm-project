import React, { useState, useEffect } from 'react';
import dayjs from 'dayjs'; // Import dayjs
import 'bootstrap/dist/css/bootstrap.min.css';
import { useDispatch, useSelector } from 'react-redux';
import { addPayment, editPayment, deletePayment, updateTotalPrice } from "@/react/redux/paiementSlice.js";
import { MdDelete } from 'react-icons/md'; // Import the MdDelete icon
import { CiEdit } from "react-icons/ci";

const PaiementForm = () => {
    const dispatch = useDispatch(); // Get dispatch function
    const payments = useSelector((state) => state.payments.payments);
    const totalTTC = useSelector((state) => state.products.totalTTC);

    const [paymentMode, setPaymentMode] = useState('Crédit');
    const [amount, setAmount] = useState(totalTTC);
    const [dueDate, setDueDate] = useState(dayjs().format('YYYY-MM-DD'));
    const [chequeOrEffet, setChequeOrEffet] = useState('');
    const [editIndex, setEditIndex] = useState(null);

    useEffect(() => {
        setAmount(totalTTC); // Automatically update amount when totalTTC changes
    }, [totalTTC]);

    const modesPaiement = [
        { id: 1, name: 'Crédit' },
        { id: 2, name: 'Espece' },
        { id: 3, name: 'Cheque' },
        { id: 4, name: 'Effet de commerce' },
        { id: 5, name: 'Virement' },
    ];

    const handlePaymentModeChange = (event) => {
        setPaymentMode(event.target.value);
        setChequeOrEffet('');
    };

    const handleButtonClick = () => {
        const newPayment = { paymentMode, amount: parseFloat(amount), dueDate, chequeOrEffet };

        if (editIndex !== null) {
            dispatch(editPayment({ index: editIndex, payment: newPayment }));
            setEditIndex(null);
        } else {
            dispatch(addPayment(newPayment));
        }

        setAmount(totalTTC); // Reset amount to totalTTC
        setDueDate(dayjs().format('YYYY-MM-DD'));
        setChequeOrEffet('');
    };

    return (
        <div className="container mt-5">
            <h2 className="text-muted">Paiement :</h2>
            <h4 className="text-muted">Total TTC à payer : {totalTTC} DH</h4>
            <div className="d-flex">
                <div style={{ width: '30%' }} className="p-4 shadow">
                    <div className="mb-3">
                        <label htmlFor="paymentMode" className="form-label">Mode paiement:</label>
                        <select id="paymentMode" className="form-select" value={paymentMode} onChange={handlePaymentModeChange}>
                            {modesPaiement.map((mode) => (
                                <option key={mode.id} value={mode.name}>{mode.name}</option>
                            ))}
                        </select>
                    </div>
                    <div className="mb-3">
                        <label htmlFor="amount" className="form-label">Montant:</label>
                        <input
                            type="number"
                            id="amount"
                            className="form-control"
                            value={amount}
                            onChange={(e) => setAmount(e.target.value)}
                        />
                    </div>
                    <div className="mb-3">
                        <label htmlFor="dueDate" className="form-label">Echéance:</label>
                        <input type="date" id="dueDate" className="form-control" value={dueDate} onChange={(e) => setDueDate(e.target.value)} />
                    </div>
                    {(paymentMode === 'Cheque' || paymentMode === 'Effet de commerce') && (
                        <div className="mb-3">
                            <label htmlFor="chequeOrEffet" className="form-label">N° Cheque ou Effet:</label>
                            <input type="text" id="chequeOrEffet" className="form-control" value={chequeOrEffet} onChange={(e) => setChequeOrEffet(e.target.value)} />
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
                                <th>Mode de paiement:</th>
                                <th>Montant:</th>
                                <th>Echéance:</th>
                                <th>N° Cheque ou Effet:</th>
                                <th>Actions:</th>
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
                                            setAmount(payment.amount);
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
                )}
            </div>
        </div>
    );
};

export default PaiementForm;
