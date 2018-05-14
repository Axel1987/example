import jobsDetailsModalCtrl from './show-job-details.controller';
import jobsDetailsModalTemplate from './show-job-details.html';

jobsCtrl.$inject = ['$scope', '$http', '$state', 'env', '$info'];
export default function jobsCtrl($scope, $http, $state, env, $info) {
    
    /** Default model of job */
    $scope.defaultJob = {
        name: '',
        company: '',
        email: '',
        phone: '',
        description: '',
        active: false
    };
    
    /** Pagination default settings */
    $scope.maxSize = 10;
    $scope.totalItems = 1;
    $scope.lastPage = 1;
    $scope.currentPage = 1;

    /** Get list of jobs */
    $scope.getJobs = function () {
        $http.get(env.apiUrl + 'talent/jobs?page='+$scope.currentPage).then(
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


    $scope.showDescription = function (job) {
        $info.jobInfo(job);
    };

    $scope.userInfo = function (user) {
        $info.userInfo(user);
    }

}
