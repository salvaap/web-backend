class UserService {
    constructor() {
        this.url = `/dashboard/users`;
    }

    encodeQuery(params) {
        return Object.keys(params).map((key) => {
            return [key, params[key]].map(encodeURIComponent).join('=');
        }).join('&');
    }

    getUsers(params) {
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

    resendVerification(email) {
        return new Promise((resolve, reject) => {
            axios.post(`${this.url}/resend-verification`, {email: email})
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    /*addUser(profile_id, user_id) {
        return new Promise((resolve, reject) => {
            axios.put(`${this.url}/${profile_id}/users/${user_id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }

    removeUser(profile_id, user_id) {
        return new Promise((resolve, reject) => {
            axios.delete(`${this.url}/${profile_id}/users/${user_id}`)
                .then(response => {
                    resolve(response.data);
                })
                .catch(error => {
                    reject(error.response.data);
                });
        });
    }*/
}

export default UserService;