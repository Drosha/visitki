builderAppCtrl.controller('PreviewsCtrl', function ($scope, $http, $location) {
    var slides = $scope.slides = [];
    $scope.sid = $location.path().substr(1);
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

    $scope.saveData = function (binding, bg) {
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $http.post('/framework/main/save', {"texts":binding, bg:bg, sid: $scope.sid}).success(function(responce) {})
    };

    $scope.switchPositions(1);
});

builderAppCtrl.controller('LoginForm', function($scope, $routeParams) {});