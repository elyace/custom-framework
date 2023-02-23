import {Provider} from "react-redux";
import React from "react";
import store from "./store.js";

const withStoreProvider = Component => {

    return props => {

        return <Provider store={store}>
            <Component {...props}/>
        </Provider>
    }

}

export { withStoreProvider }