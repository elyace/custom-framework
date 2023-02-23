import {createSlice} from "@reduxjs/toolkit";

export const listActions = createSlice({
    name: 'customers',
    initialState: {
        value: [],
        paginator: {
            last: '',
            next: '',
            previous: '',
            page_count: 0,
            current_page: 1,
            total: 0
        }
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
        },
        updatePaginator: (state, action) => {
            state.paginator = action.payload
        },
        updatePaginatorTotal: (state, action) => {
            state.paginator = {...state.paginator, total: state.paginator.total-action.payload}
        }
    }
})

export default listActions.reducer

export const { removeCustomer, initCustomers, addCustomer, updatePaginator, updatePaginatorTotal} = listActions.actions