candidatesCtrl.$inject = ['$scope', '$http', '$state', 'env', '$uibModal', '$password'];
export default function candidatesCtrl($scope, $http, $state, env, $uibModal, $password) {
    
    /** Pagination default settings */
    $scope.maxSize = 10;
    $scope.totalItems = 1;
    $scope.lastPage = 1;
    $scope.currentPage = 1;

    /** Get list of users */
    $scope.getCandidates = function () {
        $http.get(env.apiUrl + 'talent/partner-candidates?page='+$scope.currentPage).then(
            function (response) {
                $scope.candidates = response.data.data;
                /** Setup pagination */
                $scope.currentPage = response.data.current_page;
                $scope.totalItems = response.data.total;
                $scope.maxSize = response.data.per_page;
                $scope.lastPage = response.data.last_page;
            });
    };
    $scope.getCandidates();

    $scope.pageChanged = function () {
        $scope.getCandidates();
    };  
}
