import './talent-layout.scss';
import talentLayoutConfig from './talent-layout.config';

import talentDashboardModule from '../dashboard';
import talentCandidatesModule from '../candidates';
import talentPartnerCandidatesModule from '../partner-candidates';
import talentJobsModule from '../jobs';
import talentReviewsModule from '../review';
import profileTalentModule from '../profile';

export default angular.module('talentLayoutModule', [
    talentDashboardModule,
    talentJobsModule,
    talentReviewsModule,
    talentCandidatesModule,
    talentPartnerCandidatesModule,
    profileTalentModule
]).config(talentLayoutConfig)
  .name;
