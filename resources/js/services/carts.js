const apiClient = axios.create({
    baseURL: `/cart`,
    withCredentials: false,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
});

export default {
    getCart() {
        return new Promise((resolve, reject) => {
            apiClient.get(`/`).then(response => {
                resolve(response.data);
            }).catch(error => {
                reject(error.response.data);
            });
        });
    },
    addToCart(item) {
        return new Promise((resolve, reject) => {
            apiClient.post(`/`, item).then(response => {
                resolve(response.data);
            }).catch(error => {
                reject(error.response.data);
            })
        });
    },
    removeFromCart(id) {
        return new Promise((resolve, reject) => {
            apiClient.delete(`/${id}`).then(response => {
                resolve(response.data);
            }).catch(error => {
                reject(error.response.data);
            });
        })
    }
}