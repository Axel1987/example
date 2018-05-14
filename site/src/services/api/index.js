import apiService from './api-service';

export default angular.module('apiModule', [])
    .service('$api', apiService)
    .name