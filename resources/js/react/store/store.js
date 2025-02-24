// import { configureStore } from "@reduxjs/toolkit";
// import formInfoSlice from '../redux/formInfoSlice';
// import rechercheClientSlice from '../redux/recherchClientSlice';
// import addUserSlice from '../redux/addUserSlice';
// import activationTvaRemiseSlice from "@/react/redux/activationTvaRemiseSlice.js";
// import produitSlice from '../redux/produitSlice';
// // Create the Redux store
// const store = configureStore({
//     reducer: {
//         formInfo: formInfoSlice,
//         rechercheClient: rechercheClientSlice,
//         addUser: addUserSlice,
//         activation: activationSlice,
//         products: productSlice,
//
//     }
// });
//
// export default store;
import { configureStore } from "@reduxjs/toolkit";
import informationSlice from "@/react/redux/informationSlice.js";
import recherchClientSlice from "@/react/redux/recherchClientSlice.js";
import ajouterClientSlice from "@/react/redux/ajouterClientSlice.js";
import activationTvaRemiseSlice from "@/react/redux/activationTvaRemiseSlice.js";
import crudActionSlice from "@/react/redux/crudActionSlice.js";
import paiementSlice from "@/react/redux/paiementSlice.js";

// Create the Redux store
const store = configureStore({
    reducer: {
        formInfo: informationSlice,
        rechercheClient: recherchClientSlice,
        addUser: ajouterClientSlice,
        activation: activationTvaRemiseSlice,
        products: crudActionSlice,
        payments: paiementSlice,
    }
});

export default store;
