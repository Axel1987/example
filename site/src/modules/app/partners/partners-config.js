import view from './partners.html';
import partnersCtrl from './partners-controller';
partnersConfig.$inject = ['$stateProvider'];

export default function partnersConfig($stateProvider){
    $stateProvider
        .state('app.partners', {
            url:'/partners',
            controller: partnersCtrl,
            template: view,
            data:{
                className:'page-partners'
            }
        });
}