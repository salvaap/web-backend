class ActionService {
    constructor() {
        this.url = `/dashboard/actions`;
    }

    encodeQuery(params) {
        return Object.keys(params).map((key) => {
            return [key, params[key]].map(encodeURIComponent).join('=');
        }).join('&');
    }

    getActions(params) {
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
                    console.log(`Error catch: ${error}`);
                    reject(error.response.data);
                });
        });
    }
}

export default ActionService;