signInCtrl.$inject = ['$rootScope', '$scope', '$http', '$state', 'env', '$user'];
export default function signInCtrl ($rootScope, $scope, $http, $state, env, $user) {

    $scope.loginModel = {
        email: '',
        password: ''
    };

    $scope.errorMessage = '';


    $scope.signIn = function () {
        $http.post(env.apiUrl +'sign-in', $scope.loginModel).then(
            function (response) {
                var user = response.data;
                $user.setUser(user);

                if(user.user_role.role.name == 'admin'){
                    $state.go('router.app-layout.dashboard');                    
                }else{
                    $state.go('router.talent-layout.dashboard');                    
                }

            },function (error) {
                $scope.errorMessage = error.data.message;
            }
        );
    };

}
