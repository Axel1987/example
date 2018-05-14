showJobsCtrl.$inject = ['$scope', '$uibModalInstance', 'items'];

export default function showJobsCtrl ($scope, $uibModalInstance, items) {

    $scope.job = items.job;

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
}