import React, {useEffect, useState} from 'react'
import {BsArrowLeftSquare, BsArrowRightSquare} from "react-icons/bs";

import './paginator.css'
import {usePaginator} from "../useCases/paginator.js";

const Paginator = () => {

    const {pageCount, total, goToNextPage, goToPrevPage, currentPage, gotToPage} = usePaginator()

    const [page, setPage] = useState(currentPage)

    /**
     * This is so beautiful
     *
     * Prevent sending multiple call to goToPage
     */
    useEffect( () => {

        const id = setTimeout( () => {
            currentPage !== page && gotToPage(page)
        }, 1000 )

        return () => clearTimeout(id)
    }, [page, currentPage] )

    return <div className="d-flex justify-content-between align-items-center" id="paginator">
        <div>
            <button className="btn btn-outline-secondary" onClick={goToPrevPage}>
                <BsArrowLeftSquare/>
            </button>
            &nbsp;
            <button className="btn btn-outline-secondary" onClick={goToNextPage}>
                <BsArrowRightSquare/>
            </button>
        </div>
        <strong> - {total} clients - </strong>
        <div className="form-group d-flex align-items-center">
            <input type="number" className="form-control" value={page} min={1} max={pageCount} onChange={ e => setPage( parseInt(e.target.value) ) }/>
            <span>/ {pageCount}</span>
        </div>
    </div>
}

export default Paginator