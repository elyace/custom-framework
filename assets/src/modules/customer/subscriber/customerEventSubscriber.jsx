import {publish, subscribe} from "../../../shared/event.js";
import {toast} from "react-toastify";
import RemoveNotification from "../components/RemoveNotification.jsx";
import React from "react";

subscribe('removed-customer', e => {
    const handleUndoRemove = (customer) => {
        publish('undo-customer-remove', customer)
    }

    toast(<RemoveNotification customer={e.detail} onUndo={handleUndoRemove}/>)
})

subscribe('updated-customer', e => {

    toast(`Mis à jour pris en compte pour ${e.detail.first_name}`)
})