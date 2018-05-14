import './review.scss';
import adminReviewConfig from './review.config';

export default angular.module('adminReviewModule', [])
    .config(adminReviewConfig)
    .name;
