import { encodeQuery } from '../utils';

const apiClient = axios.create({
    baseURL: `/dashboard/products`,
    withCredentials: false,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

export default {
    getProducts(params) {
        let query = '';
        if(params) {
            query += '?';
            query += encodeQuery(params);
        }

        return new Promise((resolve, reject) => {
            apiClient.get(`/list${query}`)
                .then(response => {
                    resolve(response.data);
                }).catch(error => {
                    reject(error.response.data);
                });
        });
    },
    getProduct(id) {
        return new Promise((resolve, reject) => {
            apiClient.get(`/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
    deleteProduct(id) {
        return new Promise((resolve, reject) => {
            apiClient.delete(`/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
    getImages(params) {
        let query = '';
        if(params) {
            query += '?';
            query += encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            apiClient.get(`/images${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
    uploadImage(data, config) {
        return new Promise((resolve, reject) => {
            apiClient.post(`/image`, data, config)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
    uploadImages(data, config) {
        return new Promise((resolve, reject) => {
            apiClient.post(`/images`, data, config)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }
}