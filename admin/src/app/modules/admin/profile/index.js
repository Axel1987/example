import './profile.scss';
import profileAdminConfig from './profile.config';

export default angular.module('profileAdminModule', [])
    .config(profileAdminConfig)
    .name;
