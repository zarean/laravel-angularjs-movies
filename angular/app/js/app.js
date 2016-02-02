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

    function sharedProperties() {
        var query = 'aa';

        return {
            getQuery: function () {
                return query;
            },
            setQuery: function (value) {
                query = value;
            }
        };
    }

    function resultsCtrl($http, $scope, sharedProperties) {
        $scope.pal = sharedProperties.getQuery();
    }

    function autoCompleteCtrl($http, $scope, sharedProperties) {
        var _this = this;

        _this.searchTextChange = function (text) {
            sharedProperties.set(text);
        }

        _this.query = function (text) {
            var url = "http://localhost:8000/fastquery?q=" + text;

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

        $scope.Enter = function(){
            $scope.$$childHead.$mdAutocompleteCtrl.hidden = true;
            sharedProperties.setQuery(_this.searchText);
        };

    }
})();