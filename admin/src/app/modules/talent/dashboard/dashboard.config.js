import dashboardCtrl from './dashboard.controller';
import view from './dashboard.html';

dashboardConfig.$inject = ['$stateProvider'];

export default function dashboardConfig($stateProvider) {
    $stateProvider
        .state('router.talent-layout.dashboard', {
            url:'/partner/dashboard',
            controller:dashboardCtrl,
            template: view,
            data:{
                header: 'Dashboard',
                class: 'fa fa-tachometer'
            }
        })
}
