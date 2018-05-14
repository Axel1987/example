import view from './app.html';
import appCtrl from './app-controller';
appConfig.$inject = ['$stateProvider'];

export default function appConfig($stateProvider){
    $stateProvider
        .state('app', {
            abstract: true,
            controller: appCtrl,
            template: view,
            data:{
                className:'page-app'
            }
        });
}