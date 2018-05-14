infoModalCtrl.$inject = ['$scope', '$uibModalInstance', 'items'];

export default function infoModalCtrl ($scope, $uibModalInstance, items) {

    $scope.infoObj = items.infoObj;

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
}