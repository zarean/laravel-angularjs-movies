(function () {
    'use strict';
    var app = angular.module('smdbApp', ['ngMaterial']);
    app.controller('AutoCompleteCtrl', autoCompleteCtrl);
    app.controller('ResultsCtrl', resultsCtrl);
    app.service('sharedProperties', sharedProperties);
    app.directive('ngEnter', ngEnter);
    app.directive('ngItemCard', ngItemCard);
    //app.config(function ($mdThemingProvider) {
    //    $mdThemingProvider
    //        .theme('default')
    //        .primaryPalette('red')
    //        .accentPalette('pink')
    //        .warnPalette('red')
    //        .backgroundPalette('blue-grey')});

    function ngItemCard() {
        return {
            restrict: "E",
            templateUrl: "templates/ngItemCard.html",
            scope: {
                ngItem: "=",
                ngMovies: "@"
            },
            controller: function ($scope, $http) {


                if ($scope.ngItem.type === "Actor") {
                    $scope.movies = JSON.parse($scope.ngMovies);
                    angular.forEach($scope.movies, function (movie) {
                        movie.member = false;
                        angular.forEach(movie.casts, function (cast) {
                            if (cast.name === $scope.ngItem.name) {
                                movie.member = true;
                            }
                        });
                    });
                }

                $scope.mode = true;

                $scope.editClicked = function () {
                    $scope.mode = false;
                }

                $scope.doneClicked = function () {
                    var url = "http://localhost:8000/update/" + $scope.ngItem.id;
                    var data = [];
                    angular.forEach($scope.movies, function (movie) {
                        if (movie.member == true) {
                            data = data.concat(movie.id);
                        }
                    });
                    $http.put(url, {data: data}).then(function (status) {
                        console.log(status.data);
                    });
                    $scope.mode = true;
                }
            }
        };
    }

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
            var url = "http://localhost:8000/query?q=";
            $http.get(url)
                .then(function (response) {
                    _this.movies = response.data.movies;
                });
            url = url + sharedProperties.getQuery();
            $http.get(url)
                .then(function (response) {
                    angular.forEach(response.data.movies, function (value) {
                        value.sub = value.casts;
                        delete value.casts;
                        value.icon = 'movie';
                        value.type = 'Movie';
                        value.subtype = 'Cast';
                    });
                    angular.forEach(response.data.casts, function (value) {
                        value.sub = value.movies;
                        delete value.movies;
                        value.icon = 'face';
                        value.type = 'Actor';
                        value.subtype = 'Movies';
                    });
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