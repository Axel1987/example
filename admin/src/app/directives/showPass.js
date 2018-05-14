passwordInputDirective.$inject = [];

export default function passwordInputDirective() {
    
    return {
        restrict: 'E',
        scope: {
            model: "=",
            label: "="
        },
        template: '<label>{{ label }}</label> \
                    <div class="input-group mb-2 mr-sm-2 mb-sm-0"> \
                    <input class="form-control" type="{{inputType}}" placeholder="Password" ng-model="model"> \
                    <div class="input-group-addon"> \
                    <i class="fa fa-eye" aria-hidden="true" ng-mousedown="showPass()" ng-mouseup="hidePass()"></i> \
                    </div></div>',
        link: function(scope, element, attributes){
            
            scope.inputType = 'password';
            
            scope.showPass = function () {
                scope.inputType = 'text';
            };
            
            scope.hidePass = function () {
                scope.inputType = 'password';
            };
        }
    };
};