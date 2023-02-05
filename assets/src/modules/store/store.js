import {combineReducers, configureStore} from "@reduxjs/toolkit";
import listReducer from '../customer/actions/listActions'
import editReducer from '../customer/actions/editActions'
import React from "react";
import toDeleteReducer from "../customer/actions/toDeleteActions.js";

export default configureStore({
    reducer: {
        customer: combineReducers({
            list: listReducer,
            edit: editReducer,
            toDelete: toDeleteReducer,
        })
    }
})
