class HomeService {
    constructor() {
        this.url = ``;
    }

    encodeQuery(params) {
        return Object.keys(params).map((key) => {
            return [key, params[key]].map(encodeURIComponent).join('=');
        }).join('&');
    }

    getCatalog(params) {
        let query = '';
        if(params) {
            query += '?';
            query += this.encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/catalog${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    getFilters(params) {
        let query = '';
        if(params) {
            query += '?';
            query += this.encodeQuery(params);
        }
        return new Promise((resolve, reject) => {
            axios.get(`${this.url}/filters${query}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }
}

export default HomeService;