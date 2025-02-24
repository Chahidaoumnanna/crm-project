import React from "react";
import Produits from "./components/produits/Produits.jsx";
import Informations from "./components/clients/Informations.jsx";
import PaiementForm from "@/react/components/paiements/PaiementForm.jsx";
export default function App() {
    return (
        <div>
            <Informations/>
            <Produits />
            <PaiementForm />
        </div>
    );
}
