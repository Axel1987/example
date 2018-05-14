import './create-account.scss';
import createAccountConfig from './create-account-config';
export default angular.module('createAccountModule', [])
	.config(createAccountConfig)
	.name;