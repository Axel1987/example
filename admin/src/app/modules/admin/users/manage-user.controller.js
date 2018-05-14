manageUserCtrl.$inject = ['$scope', '$uibModalInstance', '$http', 'items', 'env'];

export default function manageUserCtrl ($scope, $uibModalInstance, $http, items, env) {
    
    $scope.user = items.user;
    $scope.errorMessage = [];
    $scope.roles = [];
    
    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    /** Get list of roles */
    $scope.getRoles = function () {
        $http.get(env.apiUrl + 'admin/roles').then(
            function (response) {
                $scope.roles = response.data;
            },function (error) {
                
            }
        );
    };
    $scope.getRoles();
    
    
    /** Submit user form */
    $scope.submit = function () {
        if($scope.user.id){
            $scope.editUser();
        }else{
            $scope.addUser();
        }
    };

    /** Edit user */
    $scope.editUser = function () {
        $http.put(env.apiUrl + 'admin/users/' + $scope.user.id, $scope.user).then(
            function (response) {
                $uibModalInstance.close(response.data);
            },function (error) {
                $scope.errorMessage = error.data.errors;
            }
        );
    };

    /** Add new user */
    $scope.addUser = function () {
        $http.post(env.apiUrl + 'admin/users', $scope.user).then(
            function (response) {
                $uibModalInstance.close(response.data);
            },function (error) {
                $scope.errorMessage = error.data.errors;
            }
        );
    }
}