import './users.scss';
import usersConfig from './users.config';

export default angular.module('usersModule', [])
    .config(usersConfig)
    .name;
