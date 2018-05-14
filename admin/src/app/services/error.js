errorHandlerService.$inject = ['$state', '$user'];

export default function errorHandlerService($state, $user) {
    
    var _handle = function (error) {
        switch (error.status){
            // case 401: 
            //     $state.go('router.sign-in');
            //     break;
            // default:
            //     $state.go('router.sign-in');
            //     break;
        }
    };
    
    return {
        handle: _handle
    };   
}
