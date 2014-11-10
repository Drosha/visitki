builderAppCtrl.controller('PreviewsCtrl', function ($scope, $http, $location, $routeParams) {
    var slides = $scope.slides = [];
    $scope.link = 'появится после сохранения';
    //$scope.sid = $location.path().substr(1);
    //console.log();
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
        $http.get('/data/positions.json').success(function(data) {
            $scope.positions = data[previewId];
        })
    };

    if ($routeParams.id) {
        $scope.sid = $routeParams.id;
        $http.post('/framework/main/load', {sid: $scope.sid}).success(function(data) {
            $scope.binding = {};
            $scope.binding.back = data.texts.back;
            $scope.binding.front = data.texts.front;
            $scope.link = $location.absUrl();
        })
    }

    $scope.saveData = function (binding, bg, side) {
        $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $http.post('/framework/main/save', {"texts":binding, bg:bg, sid: $scope.sid}).success(function(responce) {
            $scope.sid = responce.sid;
            $location.url($scope.sid);
            //$scope.link = $location.absUrl() + '#/'+$scope.sid;
        });
    };

    $scope.switchView = function (side) {
        $scope.side = side;
        $('#front, #back, #front_fields, #back_fields').css('display', 'none');
        $('#' + side).css('display', 'block');
        $('#' + side + '_fields').css('display', 'block');
    };

    $scope.switchView('front');
    $scope.switchPositions(1);
});

builderAppCtrl.controller('LoginForm', function($scope, $routeParams) {});