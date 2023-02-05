import {useDispatch, useSelector} from "react-redux";
import {useEffect} from "react";
import {publish} from "../../../shared/event.js";
import {add, purge, remove} from "../actions/toDeleteActions.js";
import {removeCustomer} from "../actions/listActions.js";

const useCustomerDelete = () => {

    const lines = useSelector( state => state.customer.toDelete.value )

    const dispatch = useDispatch()

    useEffect( () => {
        if( lines.length > 1 )
        {
            publish('freeze-delete-btn')
        }
    }, [lines.length])

    const deleteCustomers = () => {
        publish('release-delete-btn')
        lines.forEach( id => dispatch(removeCustomer(id)) )
        publish('removed-customers', lines)
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

    return {lines, deleteCustomers, cancelSelection, addCustomerToDelete, removeCustomerToDelete, aboutToBeDeleted}
}

export default useCustomerDelete