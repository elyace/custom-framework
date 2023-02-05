import {useDispatch, useSelector} from "react-redux";
import {set} from "../actions/editActions.js";
import {addCustomer, removeCustomer} from "../actions/listActions.js";
import {publish} from "../../../shared/event.js";

const useCustomerEdit = () => {
    const customer = useSelector(state => state.customer.edit.value)
    const dispatch = useDispatch()

    const save = (customer) => {
        dispatch(set(customer))
        dispatch(removeCustomer(customer.id))
        dispatch(addCustomer(customer))
        publish('updated-customer', customer)
    }

    return [ customer, save ]
}

export default useCustomerEdit