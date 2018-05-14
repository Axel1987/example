dashboardCtrl.$inject = ['localStorageService', '$scope', '$user', '$state', '$transitions'];
export default function dashboardCtrl($storage, $scope, $user, $state, $transitions) {

    /** Sidebar options */
    $scope.toggle = !($storage.get('toggle') ? false : true);

    $scope.toggleSidebar = function () {
        $scope.toggle = !$scope.toggle;
        $storage.set('toggle', $scope.toggle);
    };

    /** Get current user */
    $scope.user = $user.getUser();

    /** Check current user role */
    if(!$scope.user){
        $state.go('router.sign-in');
    }
    if($scope.user.user_role.role.name != 'admin'){
        $state.go('router.sign-in');
    }
    
    /** Set captions params */
    $scope.headerText = $state.current.data.header;
    $scope.headerClass = $state.current.data.class;

    /** Change header on state change success */
    $transitions.onSuccess({}, function () {
        if ($state.current.name != 'router.sign-in') {
            $scope.headerText = $state.current.data.header;
            $scope.headerClass = $state.current.data.class;

            if($scope.user.user_role.role.name != 'admin'){
                $state.go('router.sign-in');
            }
        }
    });

    /** Logout user */
    $scope.logout = function () {
        $user.removeUser();
    };

}
