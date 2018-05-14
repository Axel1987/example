import view from './hire.html';
import hireCtrl from './hire-controller';
hireConfig.$inject = ['$stateProvider'];

export default function hireConfig($stateProvider){
    $stateProvider
        .state('app.hire', {
            url:'/hire',
            controller: hireCtrl,
            template: view,
            data:{
                className:'page-hire'
            }
        });
}