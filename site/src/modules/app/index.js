import './app.scss';
import appConfig from './app-config';
import homeModule from './home';
import hireModule from './hire';
import aboutUsModule from './about-us';
import ourProcessModule from './our-process';
import cvModule from './cv';
import partnersModule from './partners';
import createAccountModule from './create-account';
import thankYouModule from './thank-you';
import ourFeesModule from './our-fees';
import profileModule from './profile';

export default angular.module('appModule', [
	homeModule,
    aboutUsModule,
    ourProcessModule,
    hireModule,
    cvModule,
    partnersModule,
    createAccountModule,
    thankYouModule,
    ourFeesModule,
    profileModule,
]).config(appConfig).name;