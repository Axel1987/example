partnersCtrl.$inject = ['$scope', '$icons', '$api'];
export default function partnersCtrl($scope, $icons, $api){
    $scope.star = $icons.star;
    $scope.partners = [];
    $api.getPartners().then(function (res) {
        $scope.partners = res.data;
    })
}
