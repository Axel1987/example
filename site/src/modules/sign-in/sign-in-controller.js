signInCtrl.$inject = ['$scope', '$icons', '$api', 'appUser', '$state', '$stateParams'];
export default function signInCtrl($scope, $icons, $api, appUser, $state, $stateParams){
    $scope.logo = $icons.logo;
    $scope.userCred = {};
    $scope.clearFieldError = $api.clearFieldError;

    $scope.signIn = function (data) {
        appUser.signIn(data).then(function () {
            $stateParams.redirectTo ? $state.go($stateParams.redirectTo): $state.go('app.home');
        }, function (errors) {
            $api.setFormErrors($scope.signInForm, errors);
        })
    }
}
