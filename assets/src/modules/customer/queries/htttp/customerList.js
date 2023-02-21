import {instance} from "../../../../shared/axios.js";

class CustomerList {

    static url = '/ajax/customer-list';

    static async findAll(page = 1, perPage = 10) {
        return await instance.get(this.url, {
            params: {
                page,
                per_page: perPage
            }
        }).then(r => r.data.content)
    }

    static async fetchWithUrl(url) {
        return await instance.get(url).then(r => r.data.content)
    }
}

export default CustomerList