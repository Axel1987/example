uploadResumeDirective.$inject = [];

export default function uploadResumeDirective() {

    return {
        restrict: 'E',
        scope: {
            model: "=",
            name: "=",
            label: "="
        },
        template: '<label for="resume">{{ label }}</label> \
                   <button id="resume" class="btn btn-default" type="file" ng-model="model" \
                        ngf-select name="{{ name }}"> \
                        Select File \
                   </button>',
        link: function(scope, element, attributes){
        }
    };
};