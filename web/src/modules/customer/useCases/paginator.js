import {useDispatch, useSelector} from "react-redux";
import CustomerList from "../queries/htttp/customerList.js";
import {initCustomers, updatePaginator} from "../actions/listActions.js";
import {env} from "../../../shared/helper/functions.js";

const usePaginator = () => {

    const paginator = useSelector(state => state.customer.list.paginator)
    const dispatch = useDispatch()

    const pageCount = paginator.page_count
    const total = paginator.total

    const goToNextPage = async () => {

        if( null === paginator.next ) return ;

        const customers = await CustomerList.fetchWithUrl(paginator.next)
        dispatch(initCustomers(customers.current))
        dispatch(updatePaginator(customers))
    }

    const goToPrevPage = async () => {

        if( null === paginator.previous ) return ;

        const customers = await CustomerList.fetchWithUrl(paginator.previous)
        dispatch(initCustomers(customers.current))
        dispatch(updatePaginator(customers))
    }

    const gotToPage = async (page) => {
        const baseUrl = env('VITE_BACKEND_URL')
        const customerUrl = CustomerList.url
        const url = `${baseUrl}${customerUrl}?page=${page}`

        const customers = await CustomerList.fetchWithUrl(url)
        dispatch(initCustomers(customers.current))
        dispatch(updatePaginator(customers))
    }

    const currentPage = paginator.current_page;

    return {pageCount, total, goToNextPage, goToPrevPage, currentPage, gotToPage}
}

export {usePaginator}