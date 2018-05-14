import './dashboard.scss';
import adminDashboardConfig from './dashboard.config';

export default angular.module('adminDashboardModule', [])
    .config(adminDashboardConfig)
    .name;
