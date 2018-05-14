import './scss/base.scss';
import config from './config.js';
import run from './run.js';
import httpRefreshTokenModule from './services/http-refresh-token';
import httpIndicator from './services/http-loading-indicator';
import svgIconsModule from './services/svg-icons';
import apiModule from './services/api';
import appUserModule from './services/app-user';
import rateDirectiveModule from './directives/rate';
import appModule from './modules/app';
import signInModule from './modules/sign-in';


var festival = angular.module('Festival', [
    'ui.router',
    'LocalStorageModule',
    'ngTouch',
    'ngAnimate',
    'angular-carousel',
    'ngFileUpload',
    httpRefreshTokenModule,
    httpIndicator,
    apiModule,
    appUserModule,
    svgIconsModule,
    rateDirectiveModule,
    signInModule,
    appModule
]),
    appBootstrap = function () {
        deferredBootstrapper.bootstrap({
            element: document,
            module: 'Festival'
        });
    };

festival
    .config(config)
    .run(run);

if (window.cordova){
    document.addEventListener('deviceready', appBootstrap);
} else {
    appBootstrap();
}