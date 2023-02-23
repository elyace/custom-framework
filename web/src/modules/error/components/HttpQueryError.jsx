import React from 'react'

const HttpQueryError = props => {

    return <>
        <strong>{ props.children }</strong><br/>
        <button className="btn btn-outline-success float-end">Reporter</button>
    </>
}

export default HttpQueryError