import { encodeQuery } from '../utils';

const apiClient = axios.create({
    baseURL: `/account`,
    withCredentials: false,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

export default {
    getUser() {
        return new Promise((resolve, reject) => {
            apiClient.get(`/user`)
                .then(response => {
                    resolve(response.data);
                }).catch(error => {
                    reject(error.response.data)
                });
        })
    },
    getDerpartments(params) {
        let query = '';
        if(params) {
            query += '?';
            query += encodeQuery(params);
        }

        return new Promise((resolve, reject) => {
            apiClient.get(`/departments${query}`)
                .then(response => {
                    resolve(response.data);
                }).catch(error => {
                    reject(error.response.data);
                });
        });
    },
    getTowns(params) {
        let query = '';
        if(params) {
            query += '?';
            query += encodeQuery(params);
        }

        return new Promise((resolve, reject) => {
            apiClient.get(`/towns${query}`)
                .then(response => {
                    resolve(response.data);
                }).catch(error => {
                    reject(error.response.data);
                });
        });
    },
    getAddresses(params) {
        let query = '';
        if(params) {
            query += '?';
            query += encodeQuery(params);
        }

        return new Promise((resolve, reject) => {
            apiClient.get(`/addresses${query}`)
                .then(response => {
                    resolve(response.data);
                }).catch(error => {
                    reject(error.response.data);
                });
        });
    },
    getAddress(id) {
        return new Promise((resolve, reject) => {
            apiClient.get(`/addresses/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
    updateAddress(id) {
        return new Promise((resolve, reject) => {
            apiClient.put(`/addresses/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
    deleteAddress(id) {
        return new Promise((resolve, reject) => {
            apiClient.delete(`/addresses/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    },
}