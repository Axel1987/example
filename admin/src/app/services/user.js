userService.$inject = ['localStorageService', '$http', 'env'];
export default function userService($storage, $http, env) {

    /** Set user in the system */
    var _setUser = function (user) {
        $storage.set('user', user);

        $http.defaults.headers.common['Authorization'] = 'Bearer ' + user.token;
        $http.defaults.cache = false;
    };

    /** Get current user */
    var _getUser = function () {
        return $storage.get('user');
    };

    /** Remove user in the system (logout) */
    var _removeUser = function () {
        $storage.remove('user');
    };

    var _checkUser = function () {
        return _getUser();
    };

    var _refreshToken = function () {
        return $http.get(env.apiUrl + 'refresh-token').then(
            function (response) {
                var token = response.data;
                var user = _getUser();

                user.token = token;
                _setUser(user);

                return token;
            }
        );
    };

    return {
        setUser: _setUser,
        getUser: _getUser,
        removeUser: _removeUser,
        checkUser: _checkUser,
        refreshToken: _refreshToken
    }
}