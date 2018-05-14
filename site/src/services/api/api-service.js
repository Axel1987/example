apiService.$inject = ['$http', 'Upload'];
export default function apiService($http, fileUpload) {
    var
        apiUrl = 'http://api.talent-savant.entenso.com/',
        api = {};

    api.setFormErrors = function (form, errors) {
        var _errors = errors.data.errors;
        for (var key in _errors){
            if (_errors.hasOwnProperty(key) && form[key]){
                form[key].$error.backend = _errors[key].join(' ');
            } else if (!form[key]){
                form[key] = {
                    $error: {
                        backend : _errors[key].join(' ')
                    }
                }
            }
        }
    };
    api.clearFieldError = function (field) {
        field.$error = {}
    };
    api.signUp = function (data) {
        return $http.post(apiUrl+'sign-up', data);
    };

    api.signIn = function (data) {
        return $http.post(apiUrl+'sign-in', data);
    };

    api.getMyProfile = function () {
        return $http.get(apiUrl+'profile');
    };

    api.addJob = function (data) {
        return $http.post(apiUrl+'client/jobs', data);
    };

    api.partnerCvUpload = function (data) {
        return fileUpload.upload({
            url: apiUrl+'partner/cv',
            data: data
        });
    };

    api.seekerCvUpload = function (data) {
        return fileUpload.upload({
            url: apiUrl+'seeker/cv',
            data: data
        });
    };
    api.refreshToken = function () {
        return $http.get(apiUrl+'refresh-token');
    };

    api.getPartners = function () {
        return $http.get(apiUrl+'partner/list')
    };
    return api;
}