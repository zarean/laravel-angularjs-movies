(function () {
    'use strict';
    var app = angular.module('smdbApp', ['ngMaterial']);
    app.controller('AutoCompleteCtrl', autoCompleteCtrl);
    app.controller('ResultsCtrl', resultsCtrl);
    app.service('sharedProperties', sharedProperties);
    app.directive('ngEnter', ngEnter);

    function ngEnter() {
        return function (scope, element, attrs) {
            element.bind("keydown keypress", function (event) {
                if (event.which === 13) {
                    scope.$apply(function () {
                        scope.$eval(attrs.ngEnter);
                    });

                    event.preventDefault();
                }
            });
        };
    }

    function sharedProperties($rootScope) {
        var query = '';

        return {
            getQuery: function () {
                return query;
            },
            setQuery: function (value) {
                query = value;
                $rootScope.$broadcast('QUERY_SET_TAG', '');
            }
        };
    }

    function resultsCtrl($http, $scope, sharedProperties) {
        var _this = this;

        $scope.$on('QUERY_SET_TAG', function (response) {
            var url = "http://localhost:8000/query?q=" + sharedProperties.getQuery();
            $http.get(url)
                .then(function (response) {
                    angular.forEach(response.data.movies, function (value) {
                        value.sub = value.casts;
                        delete value.casts;
                        value.icon = 'movie';
                    });
                    angular.forEach(response.data.casts, function (value) {
                        value.sub = value.movies;
                        delete value.movies;
                        value.icon = 'face';
                    });
                    $scope.items = response.data.movies.concat(response.data.casts);
                    _this.items = response.data.movies.concat(response.data.casts);
                });

        })

    }

    function autoCompleteCtrl($http, $scope, sharedProperties) {
        var _this = this;

        _this.searchTextChange = function (text) {
            //sharedProperties.set(text);
        }

        _this.query = function (text) {
            var url = "http://localhost:8000/fastquery?q=" + _this.searchText;

            return $http.get(url)
                .then(function (response) {
                    angular.forEach(response.data.movies, function (value) {
                        value.icon = 'movie';
                    });
                    angular.forEach(response.data.casts, function (value) {
                        value.icon = 'face';
                    });
                    $scope.items = response.data.movies.concat(response.data.casts);
                    return response.data.movies.concat(response.data.casts);
                });
        }

        $scope.Enter = function () {
            $scope.$$childHead.$mdAutocompleteCtrl.hidden = true;
            sharedProperties.setQuery(_this.searchText);
        };

    }
})();