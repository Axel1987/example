import './scss/main.scss';
import appConfig from './config';
import appRun from './run';
import userService from './services/user';
import passwordService from './services/password';
import errorHandlerService from './services/error';
import infoService from './services/info';
import refreshTokenInterceptor from './modules/http-refresh-token';
import appLayoutModule from './modules/admin/app-layout';
import talentLayoutModule from './modules/talent/talent-layout';
import signInModule from './modules/sign-in';
import envConfig from './services/config';
import passwordInputDirective from './directives/showPass'
import uploadResumeDirective from './directives/upload-resume'

var app = angular.module('talent', [
    'ui.router',
    'LocalStorageModule',
    'ui.bootstrap',
    'ngFileUpload',
    refreshTokenInterceptor,
    appLayoutModule,
    talentLayoutModule,
    signInModule
]);

app
    .config(appConfig)
    .service('$user', userService)
    .service('$password',passwordService)
    .service('env', envConfig)
    .service('errorHandler',errorHandlerService)
    .service('$info',infoService)
    .directive('inputPassword', passwordInputDirective)
    .directive('uploadResume', uploadResumeDirective)
    .run(appRun);