passwordCtrt.$inject = ['$scope', '$uibModalInstance', 'items', '$http', 'env'];

export default function passwordCtrt($scope, $uibModalInstance, items, $http, env) {
    
    $scope.user = items.user;
    $scope.errorMessages = [];
    
    $scope.pass = {
        password: '',
        password_confirmation: ''
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
    
    $scope.showPass = function (elemId) {
        angular.element(elemId).attr('type', 'text');
    };

    $scope.hidePass = function (elemId) {
        angular.element('#'+elemId).attr('type', 'password');
    };

    $scope.submit = function () {
        if($scope.pass.password == ''){
            $scope.errorMessages.danger = 'Password can\'t be empty';
            return false;
        }
        if($scope.pass.password !== $scope.pass.password_confirmation){
            $scope.errorMessages.danger = 'Passwords do not match';
            return false;
        }

        if($scope.user.id){
            $scope.user.password = $scope.pass.password;
            $scope.user.password_confirmation = $scope.pass.password_confirmation;
            $scope.updatePass();
        }
    };

    $scope.updatePass = function () {
        $scope.errorMessages = [];
        
        $http.put(env.apiUrl + 'admin/users/' + $scope.user.id, $scope.user).then(
            function (response) {
                console.log(response);


                $uibModalInstance.close();
            },function (error) {
                $scope.errorMessages = error.data.errors;
            }
        );
    };
}