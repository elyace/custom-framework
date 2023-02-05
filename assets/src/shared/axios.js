import axios from "axios";
import {env} from "./helper/functions.js";
import {publish} from "./event.js";

const instance = axios.create({
    baseURL: env('VITE_BACKEND_URL'),
    timeout: 1000,
});

instance.interceptors.response.use( res => res, error => {

    publish(`http-${error.response.status}-query-error`, error)

    return Promise.reject(error)
} )

export { instance }