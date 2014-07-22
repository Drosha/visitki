var builderAppCtrl = angular.module('builderAppCtrl', []);

builderAppCtrl.controller('PreviewsCtrl', function ($scope, $http) {
    var slides = $scope.slides = [];

    $scope.addSlide = function(i) {
        slides.push({
            image: 'images/snipets/m' + i + '.gif',
            index: i
        });
    };

    for (var i = 1; i < 6; i++) {
        $scope.addSlide(i);
    }

    $scope.switchPositions = function (previewId) {
        $http.get('/framework/main/getpositions').success(function(data) {
            $scope.positions = data[previewId];
        })
    }

    $scope.switchPositions(1);
});

builderAppCtrl.controller('LoginForm', function($scope, $routeParams) {
    //$scope.previewId = $routeParams.previewId;
});