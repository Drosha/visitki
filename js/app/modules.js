var builderAppCtrl = angular.module('builderAppCtrl', []);

angular.module('buttonDropDown', [])
    .directive('buttonDropDown', function() {
        return {
            restrict: 'E',
            scope: {model: '=', options: '='},
            controller: function () {},
            template: '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" ng-model="bgItems">Выбрать готовый<span class="caret"></span></button>'+
                '<ul class="dropdown-menu" role="menu">'+
                '<li ng-repeat="background in backgrounds"><a href="#"><div class="bg-preview" style="background-color:{{background.value}}"></div>{{background.title}}</a></li>'+
                '</ul>'
        }
    });