import {useDispatch, useSelector} from "react-redux";
import {useEffect} from "react";
import {publish} from "../../../shared/event.js";
import {add, purge, remove} from "../actions/toDeleteActions.js";
import {removeCustomer, updatePaginatorTotal} from "../actions/listActions.js";
import CustomerList from "../queries/htttp/customerList.js";

/**
 *
 * This is responsible for single or multiple customer deleting
 *
 */
const useCustomerDelete = () => {

    const lines = useSelector( state => state.customer.toDelete.value )
    const customers = useSelector(state => state.customer.list.value)

    const dispatch = useDispatch()

    useEffect( () => {
        if( lines.length > 1 )
        {
            publish('freeze-delete-btn')
        }
    }, [lines.length])

    const deleteCustomer = id => {
        const removedCustomer = customers.find(customer => customer.id === id)
        dispatch(removeCustomer(id))
        publish('removed-customer', removedCustomer)
        CustomerList.delete(id).then(() => {
            dispatch(updatePaginatorTotal(1))
        })
    }

    const deleteCustomers = () => {
        publish('release-delete-btn')
        const promise = [];
        lines.forEach( id => {
            promise.push(CustomerList.delete(id))
            dispatch(removeCustomer(id))
        } )
        Promise.all(promise).then( () => {
            dispatch(updatePaginatorTotal( lines.length))
        } )
        dispatch(purge())
    }

    const cancelSelection = () => {
        dispatch(purge())
        publish('release-delete-btn')
    }

    const addCustomerToDelete = customer => {
        dispatch(add(customer.id))
    }

    const removeCustomerToDelete = customer => {
        dispatch(remove(customer.id))
    }

    const aboutToBeDeleted = customer => {

        return lines.includes(customer.id)
    }

    const hasSelection = () => lines.length > 0

    return {lines, deleteCustomer, deleteCustomers, cancelSelection, addCustomerToDelete, removeCustomerToDelete, aboutToBeDeleted, hasSelection}
}

export default useCustomerDelete