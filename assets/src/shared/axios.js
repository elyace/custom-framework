import Axios from "axios";
import {env} from "./helper/functions.js";
import {publish} from "./event.js";
import {setupCache} from "axios-cache-interceptor/dev";

const axios = Axios.create({
    baseURL: env('VITE_BACKEND_URL'),
    timeout: 1000,
});

axios.interceptors.response.use( res => res, error => {

    publish(`http-${error.response.status}-query-error`, error)

    return Promise.reject(error)
} )

const instance = setupCache(axios, {
    debug: console.log
})

export { instance }