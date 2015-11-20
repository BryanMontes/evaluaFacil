angular.module('administracion', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('administrar', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {

            $scope.listarDataAdministrativa = [];

            var orderBy = $filter('orderBy');
            $scope.order = function (predicate, reverse) {
                $scope.listarDataAdministrativa = orderBy($scope.listarDataAdministrativa, predicate, reverse);
            };
            $scope.order('bimester', false);

            $scope.listarAdministracion = function () {
                if (localStorageService.length() != 0) {
                    $http({
                        url: server.serverUrl + '/api/',
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        $scope.listarDataAdministrativa = data.data;
                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });
                }
            }

            $scope.editarIndicadores = function (id) {
                $http({
                    url: server.serverUrl + '/api/',
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.editar = data.data;
                    $scope.editarAdministrarModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }


            $scope.editarAdministrarModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'editarIndicador',
                    controller: 'InstanciaIndicador',
                    size: size,
                    resolve: {
                        items: function () {
                            return $scope.editar;
                        }
                    }
                });
                modalInstance.result.then(function (selectedItem) {
                    $scope.selected = selectedItem;
                });
            }

        })