import React from 'react'
import {BsFillTrashFill, BsFillCheckCircleFill, BsFillXCircleFill} from 'react-icons/bs'
import {useDeleteButton} from "../../shared/behaviours/deleteBtn.js";

import './btn.css'

const DeleteButton = props => {

    const [deleting, handleClick, cancel] = useDeleteButton(props.processDelete, props.onStartDeleting, props.onEndDeleting)

    return <div className="btn-group delete-btn-group">
        <button className={`btn ${deleting ? 'btn-danger' : 'btn-outline-danger'}`} onClick={ handleClick }>
            {
                !deleting && <BsFillTrashFill/>
            }
            {
                deleting && <BsFillCheckCircleFill/>
            }
        </button>
        {
            deleting && <button className="btn btn-outline-secondary" onClick={cancel}>
                <BsFillXCircleFill/>
            </button>
        }
    </div>
}

export { DeleteButton }