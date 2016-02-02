(function () {
    'use strict';
    var app = angular.module('smdbApp', ['ngMaterial']);
    //app.controller('autoCompleteCtrl', autoCompleteCtrl);
    app.controller('DemoCtrl', DemoCtrl);

    function DemoCtrl($http, $scope) {
        var _this = this;

        _this.query = function (text) {
            var url = "http://localhost:8000/query?q=" + text;

            return $http.get(url)
                .then(function(response) {
                    angular.forEach(response.data.movies, function (value) {
                        value.icon = 'movie';
                    });
                    angular.forEach(response.data.casts, function (value) {
                        value.icon = 'face';
                    });
                    return response.data.movies.concat(response.data.casts);
                });
        }

    }

})();