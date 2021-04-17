class AttributeService {
    constructor() {
        this.url = `/dashboard/attributes`;
    }

    encodeQuery(params) {
        return Object.keys(params).map((key) => {
            return [key, params[key]].map(encodeURIComponent).join('=');
        }).join('&');
    }

    getAttributes(params) {
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

    getAttributeValues(id, params) {
        let query = '';
        if(params) {
            query += '?';
            query += this.encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/${id}/values/list${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    searchAttributes(params) {
        let query = '';
        if(params) {
            query += '?';
            query += this.encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/search${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                })
        });
    }

    searchValues(attribute_id) {
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/${attribute_id}/values/search`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                })
        });
    }

    selectAttributes(params) {
        let query = '';
        if(params) {
            query += '?';
            query += this.encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/select${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                })
        });
    }
}

export default AttributeService;