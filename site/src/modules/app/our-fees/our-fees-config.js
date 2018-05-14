import view from './our-fees.html';
import ourFeesCtrl from './our-fees-controller';
ourFeesConfig.$inject = ['$stateProvider'];

export default function ourFeesConfig($stateProvider){
    $stateProvider
        .state('app.our-fees', {
            url:'/our-fees',
            controller: ourFeesCtrl,
            template: view,
            data:{
                className:'page-our-fees'
            }
        });
}