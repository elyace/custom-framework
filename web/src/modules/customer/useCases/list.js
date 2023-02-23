import {useDispatch, useSelector} from "react-redux"
import React, {useEffect} from "react"
import {addCustomer, initCustomers, updatePaginator} from "../actions/listActions.js"
import {publish, subscribe} from "../../../shared/event.js"
import CustomerList from "../queries/htttp/customerList.js"

/**
 * Here we are making sync between state changes logic and data persist logic
 * then give it to de component
 *
 * Shown logic are business logic this is important
 *
 * @returns {{customers: *}}
 */
const useCustomerList = () => {

    const customers = useSelector(state => state.customer.list.value)

    const dispatch = useDispatch()

    useEffect(() => {
        const fetchCustomers = async () => {
            const customers = await CustomerList.findAll()
            dispatch(initCustomers(customers.current))
            dispatch(updatePaginator(customers))
        }

        fetchCustomers().then(() => publish('initiated-customer-list'))

    }, [])

    useEffect(() => {

        subscribe('undo-customer-remove', e => {
            dispatch(addCustomer(e.detail))

            // then update backend logic ...
        })

    }, [])

    return {customers}
}

export {useCustomerList}