class ProductService {
    constructor() {
        this.url = `/dashboard/products`;
    }

    encodeQuery(params) {
        return Object.keys(params).map((key) => {
            return [key, params[key]].map(encodeURIComponent).join('=');
        }).join('&');
    }

    getProducts(params) {
        let query = '';
        if(params) {
            query += '?';
            query += this.encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/list${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    deleteProduct(id) {
        return new Promise((resolve, reject) => {
            axios.delete(`${this.url}/${id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    getImages(params) {
        let query = '';
        if(params) {
            query += '?';
            query += this.encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/images${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    uploadImage(data, config) {
        return new Promise((resolve, reject) => {
            axios.post(`${this.url}/image`, data, config)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    uploadImages(data, config) {
        return new Promise((resolve, reject) => {
            axios.post(`${this.url}/images`, data, config)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }
}

export default ProductService;