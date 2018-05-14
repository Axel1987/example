import './rate.scss';
import rateDirective from './rate-directive';
export default angular.module('rateDirectiveModule',[])
    .directive('rate', rateDirective)
    .name