managePartnerCandidatesCtrl.$inject = ['$scope', '$uibModalInstance', '$http', 'items', 'env', 'Upload'];

export default function managePartnerCandidatesCtrl ($scope, $uibModalInstance, $http, items, env, Upload) {
    
    $scope.candidate = items.candidate;
    $scope.errorMessage = [];
    
    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    /**
     * Upload resume file
     * @param file
     */
    // $scope.uploadFiles = function (file) {
    //     let data = upload.uploadResume(file);
    //    
    //     data.then(function (data) {
    //         $scope.candidate.resume = data;
    //     });
    // };
    
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
            url: env.apiUrl + 'admin/partner-candidates/' + $scope.candidate.id,
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
            url: env.apiUrl + 'admin/partner-candidates',
            data: $scope.candidate
        }).then(function (response) {
            $uibModalInstance.close(response.data);
        }, function (error) {
            $scope.errorMessage = error.data.errors;
        });
    };

    /** Edit user */
    $scope.editUser = function () {
        $http.put(env.apiUrl + 'admin/partner-candidates/' + $scope.candidate.id, $scope.candidate).then(
            function (response) {
                $uibModalInstance.close(response.data);
            },function (error) {
                $scope.errorMessage = error.data.errors;
            }
        );
    };

    /** Add new user */
    $scope.addUser = function () {
        $http.post(env.apiUrl + 'admin/partner-candidates', $scope.candidate).then(
            function (response) {
                $uibModalInstance.close(response.data);
            },function (error) {
                $scope.errorMessage = error.data.errors;
            }
        );
    }
}