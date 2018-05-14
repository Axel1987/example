createAccountCtrl.$inject = ['$scope', '$api', 'appUser', '$state'];
export default function createAccountCtrl($scope, $api, appUser, $state){
    $scope.userData = {};
    $scope.clearFieldError = $api.clearFieldError;

    $scope.createAccount = function (data) {
        appUser.signUp(data).then(function () {
            $state.go('app.thank-you',{message:'Account created successfully.'});
        }, function (errors) {
            $api.setFormErrors($scope.createAccountForm, errors);
        })
    }
}
