import view from './thank-you.html';
import thankYouCtrl from './thank-you-controller';
thankYouConfig.$inject = ['$stateProvider'];

export default function thankYouConfig($stateProvider){
    $stateProvider
        .state('app.thank-you', {
            url:'/thank-you',
            controller: thankYouCtrl,
            template: view,
            data:{
                className:'page-thank-you'
            },
            params:{
                message:null
            }
        });
}