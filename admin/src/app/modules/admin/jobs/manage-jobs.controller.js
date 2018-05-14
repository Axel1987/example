manageJobsCtrl.$inject = ['$scope', '$uibModalInstance', '$http', 'items', 'env'];

export default function manageJobsCtrl ($scope, $uibModalInstance, $http, items, env) {
    
    $scope.job = items.job;
    $scope.errorMessage = [];
    
    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };

    /**
     * Get list of talents to assign
     */
    $scope.getListOfTalents = function () {
        $http.get(env.apiUrl + 'admin/users/list?role=partner').then(
            function (response) {
                $scope.talents = response.data;
            }
        );
    };
    $scope.getListOfTalents();

    /**
    * Get list of talents to clients
    */
    $scope.getListOfTalents = function () {
        $http.get(env.apiUrl + 'admin/users/list?role=client').then(
            function (response) {
                $scope.clients = response.data;
            }
        );
    };
    $scope.getListOfTalents();

    $scope.setClientData = function () {
        var client = $scope.clients.filter(function (client) {
            return client.id == $scope.job.client_id;
        })[0];
        
        $scope.job.client = client;
    };
   
    /** Submit user form */
    $scope.submit = function () {
        if($scope.job.id){
            $scope.editJob();
        }else{
            $scope.addJob();
        }
    };

    /** Edit user */
    $scope.editJob = function () {
        $http.put(env.apiUrl + 'admin/jobs/' + $scope.job.id, $scope.job).then(
            function (response) {
                $uibModalInstance.close(response.data);
            },function (error) {
                $scope.errorMessage = error.data.errors;
            }
        );
    };

    /** Add new user */
    $scope.addJob = function () {
        $http.post(env.apiUrl + 'admin/jobs', $scope.job).then(
            function (response) {
                $uibModalInstance.close(response.data);
            },function (error) {
                $scope.errorMessage = error.data.errors;
            }
        );
    };
}