appUserService.$inject = ['$q', '$http', 'localStorageService', '$api', '$state'];
export default function appUserService($q, $http, localStorageService, $api, $state) {
    var
        appUser = {},
        errorHandler = function (error) {
            return error;
        };

    appUser.user = null;
    appUser.signed = function () {
        return !!localStorageService.get('token');
    };
    appUser.setUserProfile = function (response) {
        appUser.user = response.data ? response.data : response;
        localStorageService.set('profile', appUser.user);
        return appUser.user;
    };
    appUser.getUserProfile = function () {
        var _profile = localStorageService.get('profile');
        if (_profile){
            return $q(function (resolve) {
                resolve(appUser.setUserProfile(_profile))
            })
        } else {
            return $api.getMyProfile()
                .then(appUser.setUserProfile)
        }
    };
    appUser.refreshToken = function () {
        return $api.refreshToken().then(appUser.setToken);
    };
    appUser.setToken = function (response) {
        localStorageService.set('token', response.data.token);
        $http.defaults.headers.common.Authorization = 'Bearer ' + response.data.token;
        return response.data.token;
    };
    appUser.resetToken = function () {
        var token = localStorageService.get('token');
        if (token){
            $http.defaults.headers.common.Authorization = 'Bearer ' + token;
            return true;
        } else {
            return false;
        }
    };
    appUser.signOut = function(){
        appUser.user = null;
        localStorageService.remove('token');
        localStorageService.remove('profile');
        $http.defaults.headers.common.Authorization = '';
        $state.go('app.home');
    };
    appUser.signUp = function (data) {
        return $api.signUp(data)
    };
    appUser.signIn = function (cred) {
        return $api.signIn(cred)
                    .then(appUser.setToken)
                    .then(appUser.getUserProfile);
    };
    return appUser;
}