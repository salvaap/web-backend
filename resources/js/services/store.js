import { encodeQuery } from '../utils';

const apiClient = axios.create({
    baseURL: `/store`,
    withCredentials: false,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

export default {
    getProduct(id) {
        return new Promise((resolve, reject) => {
            apiClient.get(`/products/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }
}