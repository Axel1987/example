import './jobs.scss';
import adminJobsConfig from './jobs.config';

export default angular.module('adminJobsModule', [])
    .config(adminJobsConfig)
    .name;
