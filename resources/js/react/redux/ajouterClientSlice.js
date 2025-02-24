// import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
// import axios from "axios";
//
// // Fonction asynchrone pour récupérer les groupes clients
// export const fetchGrp = createAsyncThunk(
//     "fetchGrp/fetchGrp",
//     async (groupClient, thunkAPI) => {
//         try {
//             if (!groupClient) {
//                 return thunkAPI.rejectWithValue("Le groupe client est requis.");
//             }
//
//             const response = await axios.get(
//                 `http://127.0.0.1:8000/clients_groups?search|name[partial]=${groupClient}`,
//                 {
//                     params: {
//                         "search|clientGroup.name[partial]": groupClient
//                     },
//                 }
//             );
//
//             return response.data["hydra:member"].map((clientGrp) => ({
//                 value: clientGrp.id,
//                 label: clientGrp.name,
//             }));
//         } catch (error) {
//             console.error("Erreur reçue de l'API :", error.response?.data || error.message);
//             return thunkAPI.rejectWithValue(error.response?.data?.message || "Une erreur est survenu de lapi get");
//         }
//
//     }
//
// );
//
// // Fonction asynchrone pour ajouter un client
// export const addClient = createAsyncThunk(
//     "addClient/addClient",
//     async (FormData, thunkAPI) => {
//         try {
//             const response = await axios.post(
//                 "https://testapp.novicore.ma/api/clients", // URL de l'API
//                 FormData, // Données du client à ajouter
//                 {
//                     headers: {
//                         "Content-Type": "application/json", // Type de contenu
//                     },
//                 }
//             );
//             console.log("Client added successfully:", response.data);
//             return response.data;
//         } catch (error) {
//             console.error("Erreur reçue de l'API :", error.response?.data || error.message);
//             return thunkAPI.rejectWithValue(error.response?.data?.message || "Une erreur est survenue ");
//         }
//     }
// );
//
// const initialState = {
//     groupes: [],
//     selectedGroup: null,
//     searchGroup: "",
//     loading: false,
//     error: null,
//     addClientLoading: false,
//     addClientError: null,
//     lastAddedClient: null,
// };
//
// const addUserSlice = createSlice({
//     name: "addUser",
//     initialState,
//     reducers: {
//         setSelectedGroup: (state, action) => {
//             state.selectedGroup = action.payload;
//         },
//         setSearchGroup: (state, action) => {
//             state.searchGroup = action.payload;
//         },
//         addClientSuccess: (state, action) => {
//             state.lastAddedClient = action.payload; // Sauvegarde le client ajouté
//         },
//         clearLastAddedClient: (state) => {
//             state.lastAddedClient = null; // Réinitialise après sélection
//         },
//     },
//     extraReducers: (builder) => {
//         builder
//             // Gestion de la récupération des groupes
//             .addCase(fetchGrp.pending, (state) => {
//                 state.loading = true;
//                 state.error = null;
//             })
//             .addCase(fetchGrp.fulfilled, (state, action) => {
//                 state.loading = false;
//                 state.groupes = action.payload;
//
//             })
//             .addCase(fetchGrp.rejected, (state, action) => {
//                 state.loading = false;
//                 state.error = action.payload;
//             })
//
//             // Gestion de l'ajout de client
//             .addCase(addClient.pending, (state) => {
//                 state.addClientLoading = true;
//                 state.addClientError = null;
//             })
//             .addCase(addClient.fulfilled, (state) => {
//
//                 state.addClientLoading = false;
//                 state.lastAddedClient=false;      //stocke le dernier client ajouté
//
//             })
//             .addCase(addClient.rejected, (state, action) => {
//                 state.addClientLoading = false;
//                 state.addClientError = action.payload;
//             });
//     },
// });
//
// export const { setSelectedGroup, setSearchGroup,addClientSuccess, clearLastAddedClient } = addUserSlice.actions;
// export default addUserSlice.reducer;
//
//
//
import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import axios from "axios";

export const addClient = createAsyncThunk(
    "addClient/addClient",
    async (clientData, thunkAPI) => {
        try {
            const response = await axios.post("http://127.0.0.1:8000/clients", clientData);
            return response.data;
        } catch (error) {
            return thunkAPI.rejectWithValue(error.response?.data || "Une erreur est survenue");
        }
    }
);

const initialState = {
    addClientLoading: false,
    addClientError: null,
    lastAddedClient: null,
};

const addUserSlice = createSlice({
    name: "addUser",
    initialState,
    reducers: {
        clearLastAddedClient: (state) => {
            state.lastAddedClient = null;
        },
    },
    extraReducers: (builder) => {
        builder
            .addCase(addClient.pending, (state) => {
                state.addClientLoading = true;
                state.addClientError = null;
            })
            .addCase(addClient.fulfilled, (state, action) => {
                state.addClientLoading = false;
                state.lastAddedClient = action.payload;
            })
            .addCase(addClient.rejected, (state, action) => {
                state.addClientLoading = false;
                state.addClientError = action.payload;
            });
    },
});

export const { clearLastAddedClient } = addUserSlice.actions;
export default addUserSlice.reducer;
