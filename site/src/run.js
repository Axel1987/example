run.$inject = ['$rootScope', '$state', 'appUser', '$transitions'];
export default function run($rootScope, $state, appUser, $transitions) {
    $rootScope.$state = $state;
    $rootScope.appBotstrapped = true;
    if (appUser.signed()){
        appUser.resetToken();
        appUser.getUserProfile();
    }

    $transitions.onBefore({}, function(transition) {
        var desiredState = transition.$to().name;
        switch (desiredState) {
            case 'app.hire':
            case 'app.profile':{
                if (!appUser.signed()){
                    return $state.target('sign-in',{redirectTo:desiredState});
                }
            }
        }
    })
}