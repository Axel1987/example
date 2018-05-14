appCtrl.$inject = ['$scope', '$state', '$icons', 'appUser'];
export default function appCtrl($scope, $state, $icons, appUser){
    $scope.logo = $icons.logo;
    $scope.menuActive = false;
    $scope.toggleMenu = function () {
        $scope.menuActive = !$scope.menuActive;
    };
    $scope.appUser = appUser;
}
