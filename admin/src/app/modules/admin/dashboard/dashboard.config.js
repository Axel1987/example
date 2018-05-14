import dashboardCtrl from './dashboard.controller';
import view from './dashboard.html';

dashboardConfig.$inject = ['$stateProvider'];

export default function dashboardConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout.dashboard', {
            url:'/admin/dashboard',
            controller:dashboardCtrl,
            template: view,
            data:{
                header: 'Dashboard',
                class: 'fa fa-tachometer'
            }
        })
}
