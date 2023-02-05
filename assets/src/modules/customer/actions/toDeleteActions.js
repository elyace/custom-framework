import {createSlice} from "@reduxjs/toolkit";

const toDeleteActions = createSlice({
    name: 'toDelete',
    initialState: {
        value: []
    },
    reducers: {
        add: (state, action) => {
            state.value = [...state.value, action.payload]
        },
        remove: (state, action) => {
            state.value = [...state.value.filter( id => id !== action.payload )]
        },
        purge: state => {
            state.value = []
        }
    }
})

export default toDeleteActions.reducer

export const { add, remove, purge } = toDeleteActions.actions