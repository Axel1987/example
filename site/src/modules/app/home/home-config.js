import view from './home.html';
import homeCtrl from './home-controller';
homeConfig.$inject = ['$stateProvider'];

export default function homeConfig($stateProvider){
    $stateProvider
        .state('app.home', {
            url:'/home',
            controller: homeCtrl,
            template: view,
            data:{
                className:'page-home'
            }
        });
}