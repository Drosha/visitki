var builderAppCtrl = angular.module('builderAppCtrl', [])
    .directive('buttonDropDown', function() {
        return {
            restrict: 'E',
            scope: {model: '=', backgrounds: '='},
            controller: function ($scope) {
                $scope.change = function(option){
                    $scope.model = option;
                };
            },
            template: '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" ng-model="bgItems">Выбрать готовый<span class="caret"></span></button>'+
             '<ul class="dropdown-menu" role="menu">'+
             '<li ng-repeat="background in backgrounds" ng-click="change(background.value)"><a href="#"><div class="bg-preview" style="background:{{background.value}}"></div>{{background.label}}</a></li>'+
             '</ul>'
        }
    });