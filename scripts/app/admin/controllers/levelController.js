'use strict';
angular
    .module('boxman.admin')
    .controller('levelController',
    [
        '$scope', '$http', '$location', '$routeParams', 'actionService',
        function ($scope, $http, $location, $routeParams, actionService) {
            //url: "http://www.jchip.com/boxman/api/admin/level/levelList",
            var url = '/boxman/api/admin/level/levelList';
            $scope.list = function() {
                actionService.list(
                    url,
                    { orderby: $scope.orderby, limit: $scope.limit },
                    function(data) {
                        $scope.data = data;
                    },
                    function(error) {
                        console.log(error);
                    }
                );
            };
            $scope.list();
        }
    ]);

