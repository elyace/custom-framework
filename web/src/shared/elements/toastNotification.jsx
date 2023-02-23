import ReactDOM from "react-dom/client";
import Toast from "../../components/notification/toast.jsx";

class ToastNotification extends HTMLElement {
    connectedCallback() {
        ReactDOM.createRoot(this).render(<Toast/>)
    }
}

export default ToastNotification