import './candidates.scss';
import adminCandidatesConfig from './candidates.config';

export default angular.module('adminCandidatesModule', [])
    .config(adminCandidatesConfig)
    .name;
