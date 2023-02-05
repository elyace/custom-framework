import React from 'react'

const RemoveNotification = ({closeToast, customer, onUndo}) => {
    const handleUndoClick = () => {
        onUndo && onUndo(customer)
        closeToast && closeToast()
    }

    return <span>
        <b>{customer.first_name}</b> a été supprimé &nbsp;&nbsp;
        <button className='btn btn-primary btn-sm' onClick={handleUndoClick}>Undo ?</button>
    </span>
}

export default RemoveNotification