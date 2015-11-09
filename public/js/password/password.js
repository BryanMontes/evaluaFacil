angular.module('password', ['ui.bootstrap'])
        .controller('cambiarPassword', function ($scope, $http) {
            $scope.password = {};

            $scope.cambiarPass = function () {
                var req = {
                    method: 'POST',
                    url: 'cambioPass',
                    data: {
                        passwordAnterior: $scope.password.anterior,
                    }
                }

                $http(req)
                        .success(function (data) {

                        })
                        .error(function (error) {

                        })
            }

        })
