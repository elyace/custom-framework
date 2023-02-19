import ReactDOM from "react-dom/client"
import React from "react"
import CustomerListComponent from './../components/List'

class CustomerList extends HTMLElement
{
    connectedCallback() {
        ReactDOM.createRoot(this).render(<CustomerListComponent/>)
    }
}

export default CustomerList