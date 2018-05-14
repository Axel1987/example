import signInCtrl from './sign-in.controller';
import view from './sign-in.html';

signInConfig.$inject = ['$stateProvider'];

export default function signInConfig($stateProvider) {
    $stateProvider
        .state('router.sign-in', {
            url:'/sign-in',
            controller:signInCtrl,
            template: view
        })
}
