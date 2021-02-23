export function encodeQuery(params) {
    return Object.keys(params).map((key) => {
        return [key, params[key]].map(encodeURIComponent).join('=');
    }).join('&');
}