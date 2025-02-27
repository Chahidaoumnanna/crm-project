// import { createSlice } from '@reduxjs/toolkit';
//
// // État initial
// const initialState = {
//     listeproducts: [], // Tableau pour stocker les produits
//     totalTTC: 0, // État pour stocker le total TTC
// };
//
// // Création du slice
// const productSlice = createSlice({
//     name: 'products', // Nom du slice
//     initialState, // État initial
//     reducers: {
//         // Action pour ajouter un produit
//         addProduct: (state, action) => {
//             const newProduct = { ...action.payload };
//             state.listeproducts.unshift(newProduct); // Ajoute le produit au début du tableau
//         },
//
//         // Action pour mettre à jour un produit
//         updateProduct: (state, action) => {
//             const index = state.listeproducts.findIndex((p) => p.id === action.payload.id);
//             if (index !== -1) {
//                 state.listeproducts[index] = action.payload; // Met à jour le produit
//             }
//         },
//
//         // Action pour supprimer un produit
//         deleteProduct: (state, action) => {
//             state.listeproducts = state.listeproducts.filter((p) => p.id !== action.payload); // Supprime le produit
//         },
//
//         // Action pour mettre à jour le total TTC
//         updateTotalTTC: (state, action) => {
//             state.totalTTC = action.payload; // Met à jour le total TTC avec la valeur passée en payload
//         },
//     },
// });
//
// // Export des actions
// export const { addProduct, updateProduct, deleteProduct, updateTotalTTC } = productSlice.actions;
//
// // Export du reducer
// export default productSlice.reducer;


import { createSlice } from '@reduxjs/toolkit';

// État initial
const initialState = {
    listeproducts: [], // Tableau pour stocker les produits
    totalTTC: 0, // État pour stocker le total TTC
};

// Fonction pour recalculer le total TTC
const calculateTotalTTC = (products) => {
    return products.reduce((sum, product) => sum + (product.prix * product.quantite), 0);
};

// Création du slice
const productSlice = createSlice({
    name: 'products', // Nom du slice
    initialState, // État initial
    reducers: {
        // Action pour ajouter un produit
        addProduct: (state, action) => {
            state.listeproducts.unshift(action.payload); // Ajoute le produit au début du tableau
            state.totalTTC = calculateTotalTTC(state.listeproducts);
        },

        // Action pour mettre à jour un produit
        updateProduct: (state, action) => {
            const index = state.listeproducts.findIndex((p) => p.id === action.payload.id);
            if (index !== -1) {
                state.listeproducts[index] = action.payload; // Met à jour le produit
            }
            state.totalTTC = calculateTotalTTC(state.listeproducts);
        },

        // Action pour supprimer un produit
        deleteProduct: (state, action) => {
            state.listeproducts = state.listeproducts.filter((p) => p.id !== action.payload); // Supprime le produit
            state.totalTTC = calculateTotalTTC(state.listeproducts);
        },

        // Action pour mettre à jour le total TTC
        updateTotalTTC: (state, action) => {
            state.totalTTC = action.payload; // Met à jour le total TTC avec la valeur passée en payload
        },
    },
});

// Export des actions
export const { addProduct, updateProduct, deleteProduct, updateTotalTTC } = productSlice.actions;

// Export du reducer
export default productSlice.reducer;
