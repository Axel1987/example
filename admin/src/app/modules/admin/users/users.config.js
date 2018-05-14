import usersCtrl from './users.controller';
import view from './users.html';

usersConfig.$inject = ['$stateProvider'];

export default function usersConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout.users', {
            url:'/admin/users',
            controller:usersCtrl,
            template: view,
            data: {
                header: 'Manage users',
                class: 'fa fa-users'
            }
        })
}
