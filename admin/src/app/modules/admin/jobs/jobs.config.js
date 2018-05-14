import jobsCtrl from './jobs.controller';
import view from './jobs.html';

adminJobsConfig.$inject = ['$stateProvider'];

export default function adminJobsConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout.jobs', {
            url:'/admin/jobs',
            controller:jobsCtrl,
            template: view,
            data: {
                header: 'Manage the jobs',
                class: 'fa fa-briefcase'
            }
        })
}
