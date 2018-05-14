import profileCtrl from './profile.controller';
import view from './profile.html';

profileTalentConfig.$inject = ['$stateProvider'];

export default function profileTalentConfig($stateProvider) {
    $stateProvider
        .state('router.talent-layout.profile', {
            url:'/partner/profile',
            controller:profileCtrl,
            template: view,
            data:{
                header: 'Profile',
                class: 'fa fa-user'
            }
        })
}
