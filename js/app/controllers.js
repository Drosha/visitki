builderAppCtrl.controller('PreviewsCtrl', function ($scope, $http) {
    var slides = $scope.slides = [];

    for (var i = 1; i < 6; i++) {
        slides.push({
            image: 'images/snipets/m' + i + '.gif',
            index: i
        });
    }

    $http.get('/framework/main/getbackgrounds').success(function(data) {
        $scope.backgrounds = data;
    })

    $scope.switchPositions = function (previewId) {
        $http.get('/framework/main/getpositions').success(function(data) {
            $scope.positions = data[previewId];
        })
    };

    $scope.saveData = function (binding) {
        $http.post('/framework/main/save', binding).success(function(responce) {

        })
    };

    $scope.switchPositions(1);
});

builderAppCtrl.controller('LoginForm', function($scope, $routeParams) {});