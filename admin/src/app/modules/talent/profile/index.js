import './profile.scss';
import profileTalentConfig from './profile.config';

export default angular.module('profileTalentModule', [])
    .config(profileTalentConfig)
    .name;
