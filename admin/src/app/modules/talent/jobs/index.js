import './jobs.scss';
import talentJobsConfig from './jobs.config';

export default angular.module('talentJobsModule', [])
    .config(talentJobsConfig)
    .name;
