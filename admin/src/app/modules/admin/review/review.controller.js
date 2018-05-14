reviewsCtrl.$inject = ['$rootScope', '$scope', '$http', '$state', 'env', '$user', '$info'];
export default function reviewsCtrl ($rootScope, $scope, $http, $state, env, $user, $info) {

    /** Pagination default settings */
    $scope.maxSize = 10;
    $scope.totalItems = 1;
    $scope.lastPage = 1;
    $scope.currentPage = 1;

    /** Get  lise of reviews  */
    $scope.getReviews = function () {
        $http.get(env.apiUrl + 'admin/reviews?page='+$scope.currentPage).then(
            function (response) {
                $scope.reviews = response.data.data;
                /** Setup pagination */
                $scope.currentPage = response.data.current_page;
                $scope.totalItems = response.data.total;
                $scope.maxSize = response.data.per_page;
                $scope.lastPage = response.data.last_page;
            });
    };
    $scope.getReviews();

    $scope.pageChanged = function () {
        $scope.getJobs();
    };
    
    /** Show job info */
    $scope.jobInfo = function (job, partner, client) {
        job.partner = partner;
        job.client = client;
        
        $info.jobInfo(job);
    };
    
    /** Show info from user */
    $scope.userInfo = function (user) {
        $info.userInfo(user);
    };

    /** Show info from review */
    $scope.reviewInfo = function (review) {
        $info.reviewInfo(review);
    };
}
