import talentLayoutCtrl from './talent-layout.controller';
import view from './talent-layout.html';

talentLayoutConfig.$inject = ['$stateProvider'];

export default function talentLayoutConfig($stateProvider) {
    $stateProvider
        .state('router.talent-layout', {
            abstract: true,
            controller:talentLayoutCtrl,
            template: view
        })
}
