import './home.scss';
import homeConfig from './home-config';
export default angular.module('homeModule', [])
	.config(homeConfig)
	.name;