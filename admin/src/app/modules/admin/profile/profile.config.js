import profileCtrl from './profile.controller';
import view from './profile.html';

profileAdminConfig.$inject = ['$stateProvider'];

export default function profileAdminConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout.profile', {
            url:'/admin/profile',
            controller:profileCtrl,
            template: view,
            data:{
                header: 'Profile',
                class: 'fa fa-user'
            }
        })
}
