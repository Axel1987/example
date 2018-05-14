appRun.$inject = ['$rootScope', '$user', '$state', '$transitions'];

export default function appRun($rootScope, $user, $state, $transitions) {
    $rootScope.$state = $state;
    
    if(!$user.checkUser()){
        $state.go('router.sign-in');
    }else{
        $user.setUser($user.getUser());
    }

    $transitions.onSuccess({}, function () {
        if(!$user.checkUser() && $state.current.name != 'router.sign-in'){
            $state.go('router.sign-in');
            return false;
        }
    });
}
