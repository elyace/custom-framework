import {useDispatch, useSelector} from "react-redux";
import {set} from "../actions/editActions.js";
import {addCustomer, removeCustomer} from "../actions/listActions.js";
import {publish, subscribe} from "../../../shared/event.js";
import React, {useEffect} from "react";
import {purge} from "../actions/toDeleteActions.js";

const useCustomerEdit = () => {
    const customer = useSelector(state => state.customer.edit.value)
    const dispatch = useDispatch()

    const save = (customer) => {
        dispatch(set(customer))
        dispatch(removeCustomer(customer.id))
        dispatch(addCustomer(customer))
        publish('updated-customer', customer)
    }

    useEffect( () => {
        subscribe('hide-side-tools', () => {
            dispatch(set(undefined))
        })
    }, [])

    const edit = customerToEdit => {
        if ( customer && customer.id === customerToEdit.id) {
            publish('hide-side-tools')

            return
        }
        dispatch(purge())
        publish('release-delete-btn')
        dispatch(set(customerToEdit))
        publish('show-side-tools', React.lazy(() => import('./../components/Edit')))
    }

    const onEdit = customerToEdit => {
        return customer && customer.id === customerToEdit.id
    }

    return {customer, save, edit, onEdit}
}

export default useCustomerEdit