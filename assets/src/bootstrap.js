import initCustomers from "./modules/customer/init.jsx";
import './modules/error/subscriber/httpQueryErrorSubscriber.jsx'

export function boot() {
    initCustomers()
}