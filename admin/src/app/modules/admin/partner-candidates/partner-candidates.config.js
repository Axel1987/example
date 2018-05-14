import partnerCandidatesCtrl from './partner-candidates.controller';
import view from './partner-candidates.html';

adminPartnerCandidatesConfig.$inject = ['$stateProvider'];

export default function adminPartnerCandidatesConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout.partner-candidates', {
            url:'/admin/partner-candidates',
            controller:partnerCandidatesCtrl,
            template: view,
            data:{
                header: 'Manage candidates for partners',
                class: 'fa fa-user-plus'
            }
        })
}
