import view from './about-us.html';
import aboutUsCtrl from './about-us-controller';
aboutUsConfig.$inject = ['$stateProvider'];

export default function aboutUsConfig($stateProvider){
    $stateProvider
        .state('app.about-us', {
            url:'/about-us',
            controller: aboutUsCtrl,
            template: view,
            data:{
                className:'page-about-us'
            }
        });
}