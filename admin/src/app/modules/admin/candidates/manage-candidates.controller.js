manageCandidatesCtrl.$inject = ['$scope', '$uibModalInstance', '$http', 'items', 'env', 'Upload'];

export default function manageCandidatesCtrl ($scope, $uibModalInstance, $http, items, env, Upload) {
    
    $scope.candidate = items.candidate;
    $scope.errorMessage = [];
    
    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
    
    /** Submit user form */
    $scope.submit = function () {
        if($scope.candidate.id){
            $scope.editCandidate();
        }else{
            $scope.addCandidate();
        }
    };

    /** Edit candidate */
    $scope.editCandidate = function () {
        Upload.upload({
            url: env.apiUrl + 'admin/candidates/' + $scope.candidate.id,
            data: $scope.candidate
        }).then(function (response) {
            $uibModalInstance.close(response.data);
        }, function (error) {
            $scope.errorMessage = error.data.errors;
        });
    };

    /** Add new candidate */
    $scope.addCandidate = function () {
        Upload.upload({
            url: env.apiUrl + 'admin/candidates',
            data: $scope.candidate
        }).then(function (response) {
            $uibModalInstance.close(response.data);
        }, function (error) {
            $scope.errorMessage = error.data.errors;
        });
    }
}