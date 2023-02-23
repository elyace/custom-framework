import React from 'react'
import useCustomerEdit from "../useCases/edit.js"
import {useForm} from "react-hook-form";
import {withStoreProvider} from "../../store/storeProvider.jsx";

import './edit.css'

const Edit = () => {

    const {customer, save} = useCustomerEdit()

    const { register, handleSubmit, formState: {isDirty} } = useForm({
        values: customer
    })

    return <div id='edit-customer-form'>
        <h2>
            #{customer.id} {customer.first_name} <span className='last-name'>{customer.last_name}</span>
        </h2>
        <form onSubmit={handleSubmit(save)}>
            <input
                type="hidden"
                name="id"
                {...register('id')}
            />
            <div className="form-group">
                <label htmlFor="first_name">Nom *</label>
                <input
                    name='first_name'
                    type="text"
                    className="form-control"
                    id="first_name"
                    { ...register('first_name', {required: true}) }
                />
            </div>
            <div className="form-group">
                <label htmlFor="last_name">Prénom *</label>
                <input
                    type="text"
                    className="form-control"
                    id="last_name"
                    { ...register('last_name', {required: true}) }
                />
            </div>
            <div className="form-group">
                <label htmlFor="email">Email *</label>
                <input
                    type="text"
                    className="form-control"
                    id="email"
                    { ...register('email', {required: true}) }
                />
            </div>
            <div className="form-group">
                <label htmlFor="address">Adresse *</label>
                <input
                    type="text"
                    className="form-control"
                    id="address"
                    { ...register('address', {required: true}) }
                />
            </div>
            <div className="edit-customer__help">
                <small>(*) requis</small>
            </div>
            <div className='edit-customer__actions'>
                <button className="btn btn-outline-primary" disabled={!isDirty}>Enregistrer</button>
            </div>
        </form>
    </div>
}

export default withStoreProvider(Edit)