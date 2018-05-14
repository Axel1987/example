import './dashboard.scss';
import talentDashboardConfig from './dashboard.config';

export default angular.module('talentDashboardModule', [])
    .config(talentDashboardConfig)
    .name;
