//
// import React from "react";
// import { useSelector } from "react-redux";
// import axios from "axios";
// import jsPDF from "jspdf";
// import autoTable from "jspdf-autotable";
//
// const BonLivraison = () => {
//     const listeProducts = useSelector((state) => state.products.listeproducts);
//     const selectedClient = useSelector((state) => state.rechercheClient.selectedClient);
//
//     const handleSaveBonLivraison = async () => {
//         if (!selectedClient || !selectedClient.name) {
//             alert("Sélectionnez un client avant d'enregistrer !");
//             return;
//         }
//
//         if (listeProducts.length === 0) {
//             alert("Sélectionnez au moins un produit !");
//             return;
//         }
//
//         try {
//             // 1️⃣ Création du bon de livraison
//             const bonLivraisonResponse = await axios.post("http://127.0.0.1:8000/api/bon-de-livraison", {
//                 idClient: selectedClient.id,
//                 ref: selectedClient.code.client,
//             });
//
//             const idBonDeLivraison = bonLivraisonResponse.data.data.id;
//
//             // 2️⃣ Préparation des produits avec l'ID du bon de livraison
//             const products = listeProducts.map(product => ({
//                 idProduit: product.id,
//                 qte: product.qte,
//                 prixUnitaire: product.prixRevient,
//             }));
//
//             // 3️⃣ Envoi des produits associés au bon de livraison
//             await axios.post("http://127.0.0.1:8000/api/bonLivraisonItem", {
//                 idBonDeLivraison,
//                 products,
//             });
//
//             alert("Bon de livraison et produits enregistrés avec succès !");
//
//             // 4️⃣ Générer et afficher le PDF après enregistrement
//             generatePDF(selectedClient, idBonDeLivraison, products);
//         } catch (error) {
//             console.error("Erreur lors de l'enregistrement :", error.response || error.message);
//             alert("Une erreur est survenue lors de l'enregistrement.");
//         }
//     };
//
//     // Fonction pour générer le PDF
//     const generatePDF = (client, idBonDeLivraison, products) => {
//         const doc = new jsPDF();
//
//         // ✅ En-tête du document
//         doc.setFontSize(18);
//         doc.text("Bon de Livraison", 14, 20);
//
//         // ✅ Infos du client
//         doc.setFontSize(12);
//         doc.text(`Réf: ${idBonDeLivraison}`, 14, 30);
//         doc.text(`Client: ${client.name}`, 14, 40);
//         doc.text(`Téléphone: ${client.phone}`, 14, 50);
//         doc.text(`Date: ${new Date().toLocaleDateString()}`, 14, 60);
//
//         // ✅ Tableau des produits
//         const tableColumn = ["ID", "Produit", "Quantité", "Prix Unitaire", "Total"];
//         const tableRows = products.map((product, index) => [
//             index + 1,
//             product.idProduit,
//             product.qte,
//             `${product.prixUnitaire} `,
//             `${product.qte * product.prixUnitaire} €`
//         ]);
//
//         autoTable(doc, {
//             startY: 70,
//             head: [tableColumn],
//             body: tableRows,
//         });
//
//         // ✅ Sauvegarde ou affichage du PDF
//         doc.save(`BonLivraison_${idBonDeLivraison}.pdf`);
//     };
//
//     return (
//         <div>
//             <h2>Produits du Bon de Livraison</h2>
//             <button onClick={handleSaveBonLivraison}>Enregistrer Bon de Livraison</button>
//         </div>
//     );
// };
//
// export default BonLivraison;





import React from "react";
import {useSelector} from "react-redux";
import axios from "axios";
import jsPDF from "jspdf";
import autoTable from "jspdf-autotable";

const BonLivraison = () => {
    const listeProducts = useSelector((state) => state.products.listeproducts);
    const selectedClient = useSelector((state) => state.rechercheClient.selectedClient);
    const paiements = useSelector((state) => state.payments.payments);

    const handleSaveBonLivraison = async () => {
        console.log(paiements);
        console.log(selectedClient);
        console.log(listeProducts);
        if (!selectedClient || !selectedClient.name) {
            alert("Sélectionnez un client avant d'enregistrer !");
            return;
        }

        if (listeProducts.length === 0) {
            alert("Sélectionnez au moins un produit !");
            return;
        }

        try {
            const bonLivraisonResponse = await axios.post("http://127.0.0.1:8000/api/bon-de-livraison", {
                idClient: selectedClient.id,
                ref: selectedClient.code.client,
            });

            const idBonDeLivraison = bonLivraisonResponse.data.data.id;

            const products = listeProducts.map(product => ({
                idProduit: product.id,
                qte: product.qte,
                prixUnitaire: product.prixRevient,
            }));

            // 3️⃣ Envoi des produits associés au bon de livraison
            await axios.post("http://127.0.0.1:8000/api/bonLivraisonItem", {
                idBonDeLivraison,
                products,
            });

            // ⿤ Préparation des paiements
            const paiementData = paiements.map(p => ({
                mode: p.paymentMode,
                montant: p.amount,
                echeanceAt: p.dueDate,
            }));

            // ⿥ Envoi des paiements associés au bon de livraison
            await axios.post("http://127.0.0.1:8000/api/paiements", {
                idBonDeLivraison,
                paiementData,

            });

            alert("Bon de livraison et produits enregistrés avec succès !");

            // 4️⃣ Générer et afficher le PDF après enregistrement
            generatePDF(selectedClient, idBonDeLivraison, products);
        } catch (error) {
            console.error("Erreur lors de l'enregistrement :", error.response || error.message);
            alert("Une erreur est survenue lors de l'enregistrement.");
        }
    };

    // Fonction pour générer le PDF
    const generatePDF = (client, idBonDeLivraison, products) => {
        const doc = new jsPDF();

        // ✅ En-tête du document
        doc.setFontSize(18);
        doc.text("Bon de Livraison", 14, 20);

        // ✅ Infos du client
        doc.setFontSize(12);
        doc.text(`Réf: ${idBonDeLivraison}`, 14, 30);
        doc.text(`Client: ${client.name}`, 14, 40);
        doc.text(`Téléphone: ${client.phone}`, 14, 50);
        doc.text(`Date: ${new Date().toLocaleDateString()}`, 14, 60);

        // ✅ Tableau des produits
        const tableColumn = ["ID", "Produit", "Quantité", "Prix Unitaire", "Total"];
        const tableRows = products.map((product, index) => [
            index + 1,
            product.idProduit,
            product.qte,
            `${product.prixUnitaire} `,
            `${product.qte * product.prixUnitaire} €`
        ]);

        autoTable(doc, {
            startY: 70,
            head: [tableColumn],
            body: tableRows,
        });

        // ✅ Sauvegarde ou affichage du PDF
        doc.save(`BonLivraison_${idBonDeLivraison}.pdf`);
    };

    return (
        <div>
            <h2>Produits du Bon de Livraison</h2>
            <button onClick={handleSaveBonLivraison}>Enregistrer Bon de Livraison</button>
        </div>
    );
};

export default BonLivraison;

