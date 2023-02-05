import {createSlice} from "@reduxjs/toolkit";

export const listActions = createSlice({
    name: 'customers',
    initialState: {
        value: []
    },
    reducers: {
        removeCustomer: (state, action) => {
            state.value = [...state.value.filter( customer => customer.id !== action.payload )]
        },
        initCustomers: (state, action) => {
            state.value = action.payload // expecting payload to be customer list
        },
        addCustomer: (state, action) => {
            state.value = [...state.value, action.payload]
        }
    }
})

export default listActions.reducer

export const { removeCustomer, initCustomers, addCustomer } = listActions.actions