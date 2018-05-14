import view from './sign-in.html';
import signInCtrl from './sign-in-controller';
signInConfig.$inject = ['$stateProvider'];

export default function signInConfig($stateProvider){
    $stateProvider
        .state('sign-in', {
            url: '/sign-in',
            controller: signInCtrl,
            template: view,
            data:{
                className:'page-sign-in'
            },
            params:{
                redirectTo:null
            }
        });
}