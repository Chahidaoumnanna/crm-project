import { createSlice } from '@reduxjs/toolkit';

const activationSlice = createSlice({
    name: 'activation',
    initialState: {
        isTvaActive: false,
        isRemiseActive: false,
    },
    reducers: {
        toggleTva: (state) => {
            state.isTvaActive = !state.isTvaActive;
        },
        toggleRemise: (state) => {
            state.isRemiseActive = !state.isRemiseActive;
        },
    },
});
export const { toggleTva, toggleRemise } = activationSlice.actions;
export default activationSlice.reducer;
