// import "bootstrap/dist/css/bootstrap.min.css";
// import Select from "react-select";
// import { useDispatch, useSelector } from "react-redux";
// import {fetchClients , setSelectedClient, setSearchTerm} from "@/react/redux/recherchClientSlice.js";
// import {clearLastAddedClient} from "@/react/redux/ajouterClientSlice.js";
//
//
// const RecherchClient = () => {
//     const dispatch = useDispatch();
//
//     // Récupération des données depuis Redux
//     const clients = useSelector((state) => state.rechercheClient.clients);
//     const loading = useSelector((state) => state.rechercheClient.loading);
//     const selectedClient = useSelector((state) => state.rechercheClient.selectedClient);
//
//     // Récupération du dernier client ajouté
//     const lastAddedClient = useSelector((state) => state.addUser.lastAddedClient);
//
//     // Gestion du changement de recherche
//     const handleInputChange = (inputValue) => {
//         dispatch(setSearchTerm(inputValue));
//         if (inputValue.length > 2) {
//             dispatch(fetchClients({ termeRecherche: inputValue, phoneRecherche: "", refRecherche: "" }));
//         }
//     };
//
//     // Gestion de la sélection d’un client
//     const handleSelectClient = (selectedOption) => {
//         dispatch(setSelectedClient(selectedOption ? selectedOption.clientData : null));
//     };
//
//     // Effet pour sélectionner automatiquement le dernier client ajouté
//     useEffect(() => {
//         if (lastAddedClient) {
//             dispatch(setSelectedClient(lastAddedClient));
//             dispatch(clearLastAddedClient()); // Nettoie après la mise à jour
//         }
//     }, [lastAddedClient, dispatch]);
//     // Options pour le composant Select
//     const options = clients;
//
//     // Valeur actuelle du Select
//     const selectValue =
//         selectedClient && selectedClient.id
//             ? { value: selectedClient.id, label: selectedClient.name || "Nom inconnu" }
//             : lastAddedClient && lastAddedClient.id
//                 ? { value: lastAddedClient.id, label: lastAddedClient.name || "Nom inconnu" }
//                 : null;
//     return (
//         <div className="container mt-1">
//             <Select
//                 options={options}
//                 isLoading={loading}
//                 placeholder="Rechercher un client..."
//                 onInputChange={handleInputChange} // Déclenche la recherche immédiatement
//                 onChange={handleSelectClient} // Sélectionner un client
//                 isClearable
//                 value={selectValue} // Afficher le dernier client ajouté ou le client sélectionné
//             />
//
//             {selectedClient && (
//                 <div className="mt-1 p-2 border rounded bg-light" style={{ width: '200px' }}>
//                     <strong>Compte : </strong>
//                     <span className={`text-truncate ${selectedClient.compte >= 0 ? 'text-success' : 'text-danger'}`}>
//                         {selectedClient.compte} dh
//                     </span>
//                 </div>
//             )}
//         </div>
//     );
// };
//
// export default RecherchClient;
import React, { useEffect } from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import Select from "react-select";
import { useDispatch, useSelector } from "react-redux";
import { fetchClients, setSelectedClient, setSearchTerm } from '../../redux/recherchClientSlice.js';
import { clearLastAddedClient } from '../../redux/ajouterClientSlice.js';

const RecherchClient = () => {
    const dispatch = useDispatch();

    // Sélecteurs pour accéder aux données du store
    const clients = useSelector((state) => state.rechercheClient?.clients || []);
    const loading = useSelector((state) => state.rechercheClient?.loading || false);
    const selectedClient = useSelector((state) => state.rechercheClient?.selectedClient || null);
    const lastAddedClient = useSelector((state) => state.addUser?.lastAddedClient || null);

    // Gérer le changement d'entrée dans le champ de recherche
    const handleInputChange = (inputValue) => {
        dispatch(setSearchTerm(inputValue));
        if (inputValue.length > 0) {
            dispatch(fetchClients({ search: inputValue })); // Correction : Envoi du searchTerm
        }
    };

    // Gérer la sélection d'un client
    const handleSelectClient = (selectedOption) => {
        dispatch(setSelectedClient(selectedOption ? selectedOption.clientData : null));
    };

    // Utiliser le dernier client ajouté pour pré-remplir le sélecteur
    useEffect(() => {
        if (lastAddedClient) {
            dispatch(setSelectedClient(lastAddedClient));
            dispatch(clearLastAddedClient());
        }
    }, [lastAddedClient, dispatch]);

    // Préparer les options pour le composant Select
    const options = clients.map(client => ({
        value: client.id,
        label: client.name || "Nom inconnu",
        clientData: client
    }));

    // Valeur sélectionnée pour le sélecteur
    const selectValue =
        selectedClient && selectedClient.id
            ? { value: selectedClient.id, label: selectedClient.name || "Nom inconnu" }
            : lastAddedClient && lastAddedClient.id
                ? { value: lastAddedClient.id, label: lastAddedClient.name || "Nom inconnu" }
                : null;

    return (
        <div className="container mt-1">
            <Select
                options={options}
                isLoading={loading}
                placeholder="Rechercher un client..."
                onInputChange={handleInputChange} // Gérer le changement d'entrée
                onChange={handleSelectClient} // Gérer la sélection
                isClearable
                value={selectValue} // Valeur actuelle du sélecteur
            />
        </div>
    );
};

export default RecherchClient;
