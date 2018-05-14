import view from './profile.html';
import profileCtrl from './profile-controller';
profileConfig.$inject = ['$stateProvider'];

export default function profileConfig($stateProvider){
    $stateProvider
        .state('app.profile', {
            url:'/profile',
            controller: profileCtrl,
            template: view,
            data:{
                className:'page-profile'
            }
        });
}