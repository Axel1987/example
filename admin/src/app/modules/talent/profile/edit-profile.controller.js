editProfileCtrl.$inject = ['$scope', '$uibModalInstance', '$http', 'items', 'env', 'Upload'];

export default function editProfileCtrl($scope, $uibModalInstance, $http, items, env, Upload) {

    $scope.user = items.user;
    $scope.errorMessage = [];

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    /** Edit user */
    $scope.editUser = function () {
        Upload.upload({
            url: env.apiUrl + 'profile/' + $scope.user.id,
            data: $scope.user
        }).then(
            function (response) {
                $uibModalInstance.close(response.data);
            }, function (error) {
                $scope.errorMessage = error.data.errors;
            }
        );
    };
}