import {createSlice} from "@reduxjs/toolkit";

export const editActions = createSlice({
    name: 'customerEdit',
    initialState: {
        value: undefined
    },
    reducers: {
        set: (state, action) => {
            state.value = action.payload // expecting payload to be customer
        }
    }
})

export default editActions.reducer

export const { set } = editActions.actions