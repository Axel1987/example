import view from './cv.html';
import cvCtrl from './cv-controller';
cvConfig.$inject = ['$stateProvider'];

export default function cvConfig($stateProvider){
    $stateProvider
        .state('app.cv', {
            url:'/cv/:cvOwner',
            controller: cvCtrl,
            template: view,
            data:{
                className:'page-cv'
            }
        });
}