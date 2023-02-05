import {useDispatch, useSelector} from "react-redux";
import React, {useEffect} from "react";
import {addCustomer, initCustomers, removeCustomer} from "../actions/listActions.js";
import {publish, subscribe} from "../../../shared/event.js";
import {set} from "../actions/editActions.js";
import CustomerList from "../queries/htttp/customerList.js";

/**
 * Here we are making sync between state changes logic and data persist logic
 * then give it to de component
 *
 * Shown logic are business logic this is important
 */
const useCustomerList = () => {

    const customers = useSelector( state => state.customer.list.value )

    const dispatch = useDispatch()

    useEffect( () => {
        const fetchCustomers = async () => {
            const customers = await CustomerList.findAll()
            dispatch( initCustomers(customers) )
        }

        fetchCustomers().then( () => publish('initiated-customer-list') )

    }, [])

    useEffect( () => {

        subscribe('undo-customer-remove', e => {
            dispatch(addCustomer(e.detail))

            // then update backend logic ...
        })

    }, [] )

    const remove = id => {
        const removedCustomer = customers.find( customer => customer.id === id )
        dispatch( removeCustomer(id) )
        publish('removed-customer', removedCustomer)

        // then update backend logic ...
    }

    const edit = customer => {
        dispatch(set(customer))
        publish('show-side-tools', React.lazy( () => import('./../components/Edit') ))
    }

    return [customers, remove, edit]
}

export { useCustomerList }