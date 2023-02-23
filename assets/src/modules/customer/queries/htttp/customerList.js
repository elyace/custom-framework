import {instance} from "../../../../shared/axios.js";

class CustomerList {

    static url = '/ajax/customers';

    static async findAll() {
        return await instance.get(this.url).then(r => r.data.content)
    }

    static async fetchWithUrl(url) {
        return await instance.get(url).then(r => r.data.content)
    }

    static async delete(customerId) {
        return await instance.delete(this.url + `/${customerId}`)
    }
}

export default CustomerList