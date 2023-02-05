import React from 'react'
import {DeleteButton} from "../../../components/formElements/btn.jsx";
import {useCustomerList} from "../useCases/list.js";
import {BsPencilSquare} from "react-icons/bs";
import {withStoreProvider} from "../../store/storeProvider.jsx";
import useCustomerDelete from "../useCases/delete.js";
import DeleteSelection from "./Delete.jsx";

import './list.css'

/**
 *
 * From here we are not managing business logic at all, just logic for presentation
 *
 */
const CustomerList = () => {

    const [customers, remove, edit] = useCustomerList()

    const {aboutToBeDeleted, addCustomerToDelete, removeCustomerToDelete} = useCustomerDelete()

    return <>
        <table className="table" id='customer-list'>
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Adresse</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {
                [...customers].length === 0 && <tr className='customer-list__empty'>
                <td colSpan={6}>Aucun client disponible</td>
                </tr>
            }
            {
                [...customers]
                    .sort( (c, b) => {
                        if( c.id > b.id ) return 1
                        if( c.id < b.id ) return -1
                        return 0
                    })
                    .map(customer => (
                        <tr
                            key={customer.id}
                            className={`${ aboutToBeDeleted(customer) ? 'deleting':'' }`}
                        >
                            <td>#{customer.id}</td>
                            <td>{customer.first_name}</td>
                            <td>{customer.last_name}</td>
                            <td>{customer.email}</td>
                            <td>{customer.address}</td>
                            <td>
                                <button className="btn btn-outline-primary mx-2" onClick={ () => edit(customer) } >
                                    <BsPencilSquare/>
                                </button>
                                <DeleteButton
                                    processDelete={() => remove(customer.id)}
                                    onStartDeleting={ () => addCustomerToDelete(customer) }
                                    onEndDeleting={ () => removeCustomerToDelete(customer) }
                                >Supprimer</DeleteButton>
                            </td>
                        </tr>
                    ))
            }
            </tbody>
        </table>
        <DeleteSelection/>
    </>
}

export default withStoreProvider(CustomerList)