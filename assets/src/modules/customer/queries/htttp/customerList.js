import {instance} from "../../../../shared/axios.js";

class CustomerList {

    static url= '/ajax/customer-list';

    static async findAll() {
        return await instance(this.url).then(r => r.data.content)
    }
}

export default CustomerList