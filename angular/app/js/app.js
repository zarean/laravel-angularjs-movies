(function () {
    'use strict';
    var app = angular.module('smdbApp', ['ngMaterial']);
    //app.controller('autoCompleteCtrl', autoCompleteCtrl);
    app.controller('DemoCtrl', DemoCtrl);

    function DemoCtrl($scope, $http, $timeout, $q, $log) {
        var _this = this;

        _this.states = loadAll();
        _this.querySearch = querySearch;
        _this.selectedItemChange = selectedItemChange;
        _this.searchTextChange = searchTextChange;
        _this.newState = newState;

        query('');

        function newState(state) {
            alert("Sorry! You'll need to create a Constituion for " + state + " first!");
        }

        // ******************************
        // Internal methods
        // ******************************
        /**
         * Search for states... use $timeout to simulate
         * remote dataservice call.
         */
        function querySearch(query) {
            console.log(query);
            return _this.out;
        }

        function query(text) {
            var url = "http://localhost:8000/query?q=" + text;
            $http({
                method: 'GET',
                url: url
            }).
            success(function (status) {
                $scope.results = status.movies;
                angular.forEach(status.movies, function(value, key) {
                    var display = value.title;
                    angular.forEach(value.casts, function(subvalue, subkey) {
                        display = display + subvalue.name;
                    });
                    value.display = display;
                });
                _this.out = status.movies;
            }).
            error(function (status) {
                $scope.results = status;
            });
        }

        function searchTextChange(text) {
            $log.info('Text changed to ' + text);
            query(text);
        }

        function selectedItemChange(item) {
            $log.info('Item changed to ' + JSON.stringify(item));
        }

        /**
         * Build `states` list of key/value pairs
         */
        function loadAll() {
            var allStates = 'Alabama, Alaska, Arizona, Arkansas, California, Colorado, Connecticut, Delaware,\
              Florida, Georgia, Hawaii, Idaho, Illinois, Indiana, Iowa, Kansas, Kentucky, Louisiana,\
              Maine, Maryland, Massachusetts, Michigan, Minnesota, Mississippi, Missouri, Montana,\
              Nebraska, Nevada, New Hampshire, New Jersey, New Mexico, New York, North Carolina,\
              North Dakota, Ohio, Oklahoma, Oregon, Pennsylvania, Rhode Island, South Carolina,\
              South Dakota, Tennessee, Texas, Utah, Vermont, Virginia, Washington, West Virginia,\
              Wisconsin, Wyoming';
            console.log(allStates.split(/, +/g).map(function (state) {
                return {
                    value: state.toLowerCase(),
                    display: state
                };
            }));
            return allStates.split(/, +/g).map(function (state) {
                return {
                    value: state.toLowerCase(),
                    display: state
                };
            });
        }

        /**
         * Create filter function for a query string
         */
        function createFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);
            return function filterFn(state) {
                return (state.value.indexOf(lowercaseQuery) === 0);
            };
        }
    }

})();