import './profile.scss';
import profileConfig from './profile-config';
export default angular.module('profileModule', [])
	.config(profileConfig)
	.name;