import React from "react";
import ReactDOM from "react-dom/client";
import CustomerList from "./components/List.jsx";

import './subscriber/customerEventSubscriber.jsx'

export default async function initCustomers() {

    ReactDOM.createRoot(document.getElementById('customer-list')).render(<CustomerList/>)
}