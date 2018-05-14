import view from './our-process.html';
import ourProcessCtrl from './our-process-controller';
ourProcessConfig.$inject = ['$stateProvider'];

export default function ourProcessConfig($stateProvider){
    $stateProvider
        .state('app.our-process', {
            url:'/our-process',
            controller: ourProcessCtrl,
            template: view,
            data:{
                className:'page-our-process'
            }
        });
}