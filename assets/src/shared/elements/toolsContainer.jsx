import ReactDOM from "react-dom/client"
import ToolsContainerComponent from './../../components/tools/ToolsContainer'

class ToolsContainer extends HTMLElement {
    connectedCallback() {

        ReactDOM.createRoot(this).render(<ToolsContainerComponent/>)
    }
}

export default ToolsContainer