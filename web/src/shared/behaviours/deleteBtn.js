import {useEffect, useState} from "react";
import {subscribe} from "../event.js";

const useDeleteButton = (processDelete, onStartDelete, onEndDelete) => {

    const [deleting, setDeleting] = useState(false)

    const handleClick = () => {
        if( !deleting ) {
            setDeleting(true)
            onStartDelete && onStartDelete()
        }

        const timeout = setTimeout( () => {
            cancel()
        }, 10000 )

        subscribe('freeze-delete-btn', () => clearTimeout(timeout))
        subscribe('release-delete-btn', () => {
            cancel()
        })

        if( deleting )
        {
            setDeleting(false)
            onEndDelete && onEndDelete()
            processDelete()
        }
    }

    const cancel = () => {
        setDeleting(false)
        onEndDelete && onEndDelete()
    }

    return [ deleting, handleClick, cancel ]
}

export { useDeleteButton }