// import axios from "axios";
//
// // Action asynchrone pour récupérer les clients depuis l'API
// export const fetchClients = createAsyncThunk(
//     "clients/fetchClients",
//     async ({ termeRecherche, phoneRecherche, refRecherche }) => {
//         try {
//             if (!termeRecherche) {
//                 return [];
//             }
//
//             const response = await axios.get(
//                 `http://127.0.0.1:8000/clients?search[fullName][partial]=${termeRecherche}&search[ref]=${refRecherche}&search[phone]=${phoneRecherche}`,
//                 {
//                     params: {
//                         "search[fullName][partial]": termeRecherche,
//                         "search[ref][partial]": refRecherche,
//                         "search[phone][partial]": phoneRecherche,
//                     },
//                 }
//             );
//
//             // Transformer les résultats en format compatible avec React-Select
//             return response.data["hydra:member"].map((client) => ({
//                 value: client.id,
//                 label: client.fullName,
//                 compte: client.compte,
//                 clientData: client, // Stocker les données complètes pour une utilisation ultérieure
//             }));
//         } catch (error) {
//             return rejectWithValue(error.response?.data || "Erreur lors du chargement des clients");
//         }
//     }
// );
//
// // Définition de l’état initial
// const initialState = {
//     clients: [],
//     selectedClient: null,
//     searchTerm: "",
//     loading: false,
//     error: null,
// };
//
// // Création du slice Redux
// const rechercheClientSlice = createSlice({
//     name: "clients",
//     initialState,
//     reducers: {
//         setSelectedClient: (state, action) => {
//             state.selectedClient = action.payload;
//         },
//         setSearchTerm: (state, action) => {
//             state.searchTerm = action.payload;
//         },
//     },
//     extraReducers: (builder) => {
//         builder
//             .addCase(fetchClients.pending, (state) => {
//                 state.loading = true;
//                 state.error = null;
//             })
//             .addCase(fetchClients.fulfilled, (state, action) => {
//                 state.loading = false;
//                 state.clients = action.payload;
//             })
//             .addCase(fetchClients.rejected, (state, action) => {
//                 state.loading = false;
//                 state.error = action.payload;
//             });
//     },
// });
//
// export const { setSelectedClient, setSearchTerm } = rechercheClientSlice.actions;
// export default rechercheClientSlice.reducer;
import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import axios from "axios";

export const fetchClients = createAsyncThunk(
    "rechercheClient/fetchClients", // Correction du nom de l'action
    async ({ search }, { rejectWithValue }) => { // Ajout du paramètre de recherche
        try {
            const response = await axios.get(`http://127.0.0.1:8000/api/clients`, {
                params: { search }
            });
            return response.data;
        } catch (error) {
            console.error("Erreur lors de la récupération des clients:", error);
            return rejectWithValue(error.response?.data || "Erreur inconnue");
        }
    }
);

const initialState = {
    clients: [],
    selectedClient: null,
    searchTerm: "",
    loading: false,
    error: null,
};

const rechercheClientSlice = createSlice({
    name: "rechercheClient", // ✅ Correction du nom du slice pour être cohérent avec le store
    initialState,
    reducers: {
        setSelectedClient: (state, action) => {
            state.selectedClient = action.payload;
        },
        setSearchTerm: (state, action) => {
            state.searchTerm = action.payload;
        },
    },
    extraReducers: (builder) => {
        builder
            .addCase(fetchClients.pending, (state) => {
                state.loading = true;
                state.error = null;
            })
            .addCase(fetchClients.fulfilled, (state, action) => {
                state.loading = false;
                state.clients = Array.isArray(action.payload) ? action.payload : []; // ✅ Vérification pour éviter une erreur
            })
            .addCase(fetchClients.rejected, (state, action) => {
                state.loading = false;
                state.error = action.payload || "Une erreur est survenue lors du chargement des clients.";
                console.error("Erreur Redux:", state.error);
            });
    },
});

export const { setSelectedClient, setSearchTerm } = rechercheClientSlice.actions;
export default  rechercheClientSlice.reducer;
