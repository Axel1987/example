import './app-layout.scss';
import appLayoutConfig from './app-layout.config';
import adminDashboardModule from '../dashboard';
import usersModule from '../users';
import adminCandidatesModule from '../candidates';
import adminPartnerCandidatesModule from '../partner-candidates';
import adminJobsModule from '../jobs';
import adminReviewModule from '../review';
import profileAdminModule from '../profile';

export default angular.module('appLayoutModule', [
    adminDashboardModule,
    usersModule,
    adminCandidatesModule,
    adminPartnerCandidatesModule,
    adminJobsModule,
    adminReviewModule,
    profileAdminModule
]).config(appLayoutConfig)
  .name;
