import {instance} from "../../../../shared/axios.js";

class CustomerList {

    static url= '/mock/customers.json';

    static async findAll() {
        return await instance(this.url).then(r => r.data)
    }
}

export default CustomerList