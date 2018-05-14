refreshTokenInterceptor.$inject = ['$q', '$injector', '$state'];

export default function refreshTokenInterceptor($q, $injector, $state) {
    return {
        request: function (config) {
            return config;
        },
        requestError: function (rejection) {
            return $q.reject(rejection);
        },
        response: function (response) {
            return response;
        },
        responseError: function (rejection) {

            var appUser = $injector.get('appUser'),
                $http = $injector.get('$http'),
                httpConfig = rejection.config;
            
            switch (rejection.status){
                case 401:
                    if(rejection.data.message.indexOf('token') != -1 || rejection.data.message.indexOf('Token') != -1){
                        return appUser.refreshToken().then(function (data) {
                            httpConfig.headers['Authorization'] = 'Bearer '+ data;
                            return $http(httpConfig);
                        });                        
                    }else{
                        return $q.reject(rejection);
                    }
                case 403:
                    $appUser.removeUser();
                    $state.go('router.sign-in');
                    return $q.reject(rejection);
                case 500:
                    if(rejection.data.message == "The token has been blacklisted"){
                        $state.go('router.sign-in');
                        return $q.reject(rejection);
                    }
                    return $q.reject(rejection);
                default:
                    return $q.reject(rejection);
            }
        }
    };
}