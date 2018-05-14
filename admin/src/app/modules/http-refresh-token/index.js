import refreshTokenInterceptor from './refresh-token-interceptor';
import config from './refresh-token-config';

export default angular.module('httpRefreshToken', [])
    .service('refreshTokenInterceptor', refreshTokenInterceptor)
    .config(config)
    .name;