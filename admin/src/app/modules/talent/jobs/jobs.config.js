import jobsCtrl from './jobs.controller';
import view from './jobs.html';

talentJobsConfig.$inject = ['$stateProvider'];

export default function talentJobsConfig($stateProvider) {
    $stateProvider
        .state('router.talent-layout.jobs', {
            url:'/partner/jobs',
            controller:jobsCtrl,
            template: view,
            data: {
                header: 'My jobs',
                class: 'fa fa-briefcase'
            }
        })
}
