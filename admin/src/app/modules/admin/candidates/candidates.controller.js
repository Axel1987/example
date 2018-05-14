import candidatesModalCtrl from './manage-candidates.controller';
import candidatesModalTemplate from './manage-candidates.modal.html';

candidatesCtrl.$inject = ['$scope', '$http', '$state', 'env', '$uibModal', '$password'];
export default function candidatesCtrl($scope, $http, $state, env, $uibModal, $password) {
    
    /** Default model of user */
    $scope.defaultCandidate = {
        name: '',
        email: '',
        phone: '',
        resume: ''
    };
    
    /** Pagination default settings */
    $scope.maxSize = 10;
    $scope.totalItems = 1;
    $scope.lastPage = 1;
    $scope.currentPage = 1;

    /** Get list of users */
    $scope.getCandidates = function () {
        $http.get(env.apiUrl + 'admin/candidates?page='+$scope.currentPage).then(
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
    
    /** Edit User */    
    $scope.editCandidate = function (index) {
        var modalInstance = $uibModal.open({
            template: candidatesModalTemplate,
            controller: candidatesModalCtrl,
            resolve: {
                items: {
                    candidate: angular.copy($scope.candidates[index])
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.candidates[index] = result;
        });
    };
    
    /** Create new user */
    $scope.addCandidate = function () {
        var modalInstance = $uibModal.open({
            template: candidatesModalTemplate,
            controller: candidatesModalCtrl,
            resolve: {
                items: {
                    candidate: angular.copy($scope.defaultCandidate)
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.candidates.push(result);
        });
    }

}
