import './sign-in.scss';
import signInConfig from './sign-in.config';

export default angular.module('signInModule', [])
    .config(signInConfig)
    .name;
