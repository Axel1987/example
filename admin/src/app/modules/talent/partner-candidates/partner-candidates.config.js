import partnerCandidatesCtrl from './partner-candidates.controller';
import view from './partner-candidates.html';

partnerPartnerCandidatesConfig.$inject = ['$stateProvider'];

export default function partnerPartnerCandidatesConfig($stateProvider) {
    $stateProvider
        .state('router.talent-layout.partner-candidates', {
            url:'/partner/partner-candidates',
            controller:partnerCandidatesCtrl,
            template: view,
            data:{
                header: 'List of candidates for partners',
                class: 'fa fa-user-plus'
            }
        })
}
