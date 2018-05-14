import './partner-candidates.scss';
import adminPartnerCandidatesConfig from './partner-candidates.config';

export default angular.module('talentPartnerCandidatesModule', [])
    .config(adminPartnerCandidatesConfig)
    .name;
