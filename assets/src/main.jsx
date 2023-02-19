import React from 'react'
import ToastNotification from "./shared/elements/toastNotification.jsx";
import ToolsContainer from "./shared/elements/toolsContainer.jsx";
import 'bootstrap/dist/css/bootstrap.min.css'
import './assets/main.css'

import './bootstrap'

window.customElements.define('toast-notification', ToastNotification)
window.customElements.define('tools-container', ToolsContainer)
