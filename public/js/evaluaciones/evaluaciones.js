angular.module('evaluaciones', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('captura_evaluaciones', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {

            $scope.listarEvaluacion = [];
            $scope.arregloLocal = localStorageService.get('asignaciones');
            $scope.evaluar = [];

            setTimeout(function (){
                $(".active").click();
            },100)
            /*orderBy: ordena los alumnos por los campos seleccionados*/
            var orderBy = $filter('orderBy');
            $scope.order = function (predicate, reverse) {
                $scope.listarEvaluacion = orderBy($scope.listarEvaluacion, predicate, reverse);
            };
            $scope.order('first_name', false);

            $scope.listarEvaluaciones = function (id) {
                if (localStorageService.length() != 0) {

                    $http({
                        url: server.serverUrl + '/api/evaluations/current/group/pending/' + id,
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        $scope.listarEvaluacion = data.data;
                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });

                }
            }
        })
        