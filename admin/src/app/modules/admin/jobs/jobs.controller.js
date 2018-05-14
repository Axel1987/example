import jobsModalCtrl from './manage-jobs.controller';
import jobsModalTemplate from './manage-jobs.modal.html';

jobsCtrl.$inject = ['$scope', '$http', '$state', 'env', '$uibModal', '$info'];
export default function jobsCtrl($scope, $http, $state, env, $uibModal, $info) {
    
    /** Default model of job */
    $scope.defaultJob = {
        description: '',
        active: false,
        client_id: null
    };
    
    /** Pagination default settings */
    $scope.maxSize = 10;
    $scope.totalItems = 1;
    $scope.lastPage = 1;
    $scope.currentPage = 1;

    /** Get list of jobs */
    $scope.getJobs = function () {
        $http.get(env.apiUrl + 'admin/jobs?page='+$scope.currentPage).then(
            function (response) {
                $scope.jobs = response.data.data;
                /** Setup pagination */
                $scope.currentPage = response.data.current_page;
                $scope.totalItems = response.data.total;
                $scope.maxSize = response.data.per_page;
                $scope.lastPage = response.data.last_page;
            });
    };
    $scope.getJobs();

    $scope.pageChanged = function () {
        $scope.getJobs();
    };
    
    /** Edit User */    
    $scope.editJob = function (index) {
        var modalInstance = $uibModal.open({
            template: jobsModalTemplate,
            controller: jobsModalCtrl,
            resolve: {
                items: {
                    job: angular.copy($scope.jobs[index])
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.jobs[index] = result;
        });
    };
    
    /** Create new user */
    $scope.addJob = function () {
        var modalInstance = $uibModal.open({
            template: jobsModalTemplate,
            controller: jobsModalCtrl,
            resolve: {
                items: {
                    job: angular.copy($scope.defaultJob)
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.jobs.push(result);
        });
    };
    
    $scope.showDescription = function (job) {
        $info.jobInfo(job);
    };

    $scope.userInfo = function (user) {
        $info.userInfo(user);
    }

}
