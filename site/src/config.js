config.$inject = ['$stateProvider', '$urlRouterProvider','localStorageServiceProvider'];
export default function config($stateProvider, $urlRouterProvider, localStorageServiceProvider) {
    localStorageServiceProvider
        .setPrefix('festival')
        .setStorageType('sessionStorage');
    $urlRouterProvider.otherwise('/home');
}