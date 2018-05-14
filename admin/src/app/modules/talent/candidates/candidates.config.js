import candidatesCtrl from './candidates.controller';
import view from './candidates.html';

talentCandidatesConfig.$inject = ['$stateProvider'];

export default function talentCandidatesConfig($stateProvider) {
    $stateProvider
        .state('router.talent-layout.candidates', {
            url:'/partner/candidates',
            controller:candidatesCtrl,
            template: view,
            data:{
                header: 'List of candidates',
                class: 'fa fa-user-circle-o'
            }
        })
}
