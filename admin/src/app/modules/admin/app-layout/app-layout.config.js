import appLayoutCtrl from './app-layout.controller';
import view from './app-layout.html';

appLayoutConfig.$inject = ['$stateProvider'];

export default function appLayoutConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout', {
            abstract: true,
            controller:appLayoutCtrl,
            template: view
        })
}
