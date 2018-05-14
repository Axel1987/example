import './candidates.scss';
import talentCandidatesConfig from './candidates.config';

export default angular.module('talentCandidatesModule', [])
    .config(talentCandidatesConfig)
    .name;
