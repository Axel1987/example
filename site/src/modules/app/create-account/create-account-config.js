import view from './create-account.html';
import createAccountCtrl from './create-account-controller';
createAccountConfig.$inject = ['$stateProvider'];

export default function createAccountConfig($stateProvider){
    $stateProvider
        .state('app.create-account', {
            url:'/create-account',
            controller: createAccountCtrl,
            template: view,
            data:{
                className:'page-create-account'
            }
        });
}