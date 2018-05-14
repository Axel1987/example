import reviewCtrl from './review.controller';
import view from './review.html';

reviewsConfig.$inject = ['$stateProvider'];

export default function reviewsConfig($stateProvider) {
    $stateProvider
        .state('router.app-layout.reviews', {
            url:'/admin/reviews',
            controller:reviewCtrl,
            template: view,
            data:{
                header: 'Reviews',
                class: 'fa fa-file-text-o'
            }
        })
}
