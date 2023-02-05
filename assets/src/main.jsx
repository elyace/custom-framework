import React from 'react'
import ReactDOM from 'react-dom/client'
import roots from './shared/componentHooks.jsx'

import 'bootstrap/dist/css/bootstrap.min.css';
import './assets/main.css'

import { boot } from './bootstrap'

roots.map(root => {
    const element = document.getElementById(root.id);
    if (null !== element) {

        const Component = root.component
        return ReactDOM.createRoot(element).render(
            <React.StrictMode>
                <Component/>
            </React.StrictMode>
        )

    }

})

boot();
