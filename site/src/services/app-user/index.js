import appUserService from './app-user-service';

export default angular.module('appUserModule', [])
    .service('appUser', appUserService)
    .name