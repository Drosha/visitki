var builderApp = angular.module('builderApp', [
    'ngRoute',
    'builderAppCtrl',
    'ui.mask'
]);

builderApp.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/login', {
                templateUrl: 'views/login.html',
                controller: 'LoginForm'
            }).
            otherwise({
                templateUrl: 'views/positions.html',
                controller: 'PreviewsCtrl'
            });
    }
]);