hireCtrl.$inject = ['$scope', 'appUser', '$api', '$state'];
export default function hireCtrl($scope, appUser, $api, $state){
    $scope.user = appUser.user;
    $scope.userData = {};
    $scope.clearFieldError = $api.clearFieldError;
    $scope.resetJobData = function () {
        $scope.jobData = {
            client_id: $scope.user.id,
            description:''
        };
    };

    $scope.resetJobData();

    $scope.hireHuman = function (data) {
        return $api.addJob(data).then(function (success) {
            $scope.resetJobData();
            $state.go('app.thank-you',{message:'Jop added successfully.'})
        }, function (errors) {
            $api.setFormErrors($scope.hireForm, errors);
        })
    }
}
