import useCustomerDelete from "../useCases/delete.js";
import {toast} from "react-toastify";
import {withStoreProvider} from "../../store/storeProvider.jsx";

import './delete.css'

const DeleteSelection = () => {

    const {lines, cancelSelection} = useCustomerDelete()

    const confirmDelete = () => {
        const ConfirmComponent = withStoreProvider(ConfirmSelectionDelete)
        toast(<ConfirmComponent/>)
    }

    if( lines.length <= 1 ) return <></>

    return <div className='customer-list__select-actions'>
        <div>
            <button className="btn btn-outline-danger" onClick={confirmDelete}>Supprimer la sélection</button>
            <button className="btn btn-outline-secondary" onClick={cancelSelection}>Annuler la sélection</button>
        </div>
        <p> { lines.length } clients sélectionnés </p>
    </div>
}

const ConfirmSelectionDelete = () => {

    const {lines, deleteCustomers} = useCustomerDelete()

    return <>
        <p>Estes-vous sûr de vouloir supprimer les {lines.length} clients sélectionnés</p>
        <hr/>
        <div className="d-flex justify-content-between">
            <button className="btn btn-outline-danger" onClick={deleteCustomers}>Supprimer</button>
            <button className="btn btn-outline-secondary">Annuler</button>
        </div>
    </>
}

export default DeleteSelection