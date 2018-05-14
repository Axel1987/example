import view from './rate.html';
rateDirective.$inject = [];
export default function rateDirective() {
    return {
        restrict:'E',
        scope:{
            value:'=',
            maxValue:'='
        },
        template: view,
        link: function (scope) {
            scope.$watch('maxValue', function (newVal) {
                if (newVal){
                    scope.stars = new Array(newVal);
                }
            })
        }
    }
}