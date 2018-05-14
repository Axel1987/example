cvCtrl.$inject = ['$scope', '$api', '$state', '$stateParams'];
export default function cvCtrl($scope, $api, $state, $stateParams){
    $scope.cvData = {};
    $scope.clearFieldError = $api.clearFieldError;
    $scope.headText = $stateParams.cvOwner === 'partner' ? 'For candidates' : 'Drop a resume';

    $scope.uploadCv = function (data) {
        $api[$stateParams.cvOwner+'CvUpload'](data).then(function (success) {
            $scope.cvData = {};
            $state.go('app.thank-you',{message:'Your role has been submitted.'})
        }, function (errors) {
            $api.setFormErrors($scope.cvForm, errors);
        });
    }
}
