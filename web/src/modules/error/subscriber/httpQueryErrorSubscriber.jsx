import {subscribe} from "../../../shared/event.js";
import {toast} from "react-toastify";
import HttpQueryError from "../components/HttpQueryError.jsx";

subscribe('http-404-query-error', e => {

    toast(<HttpQueryError>Une erreur est survenu lors de la dernière action</HttpQueryError>, {
        type: toast.TYPE.ERROR
    })
})

subscribe('http-500-query-error', e => {

    toast(<HttpQueryError>Une erreur est survenu lors de la dernière action</HttpQueryError>, {
        type: toast.TYPE.ERROR
    })
})