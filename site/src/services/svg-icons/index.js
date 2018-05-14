import svgIcons from './svg-icons-service';
export default angular.module('svgIconsModule',[])
    .service('$icons', svgIcons)
    .name