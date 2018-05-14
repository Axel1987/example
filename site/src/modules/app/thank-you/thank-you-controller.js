thankYouCtrl.$inject = ['$scope', '$stateParams'];
export default function thankYouCtrl($scope, $stateParams){
    $scope.message = $stateParams.message;
}
