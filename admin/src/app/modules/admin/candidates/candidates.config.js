import candidatesCtrl from './candidates.controller';
import view from './candidates.html';

adminCandidatesConfig.$inject = ['$stateProvider'];

export default function adminCandidatesConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout.candidates', {
            url:'/admin/candidates',
            controller:candidatesCtrl,
            template: view,
            data:{
                header: 'Manage candidates',
                class: 'fa fa-user-circle-o'
            }
        })
}
