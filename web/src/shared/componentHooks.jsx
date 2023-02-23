import Hello from "../modules/Hello.jsx";
import Toast from "../components/notification/toast.jsx";
import ToolsContainer from "../components/tools/ToolsContainer.jsx";

export default [
    {
        id: 'hello',
        component: Hello
    },
    {
        id: 'notifications',
        component: Toast
    },
    {
        id: 'tools',
        component: ToolsContainer
    }
]