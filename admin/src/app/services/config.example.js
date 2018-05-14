envConfig.$inject = [];
export default function envConfig() {
    /** Base url to API */
    var _apiUrl = 'http://talent-api.loc/';

    return {
        apiUrl: _apiUrl
    }
}
