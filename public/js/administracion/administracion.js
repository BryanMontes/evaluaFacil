angular.module('administracion', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('administrar', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {

            $scope.listarDataAdministrativa = [];
            $scope.meses = [
                "Enero", "Febrero", "Marzo",
                "Abril", "Mayo", "Junio", "Julio",
                "Agosto", "Septiembre", "Octubre",
                "Noviembre", "Diciembre"
            ];
            var orderBy = $filter('orderBy');
            $scope.order = function (predicate, reverse) {
                $scope.listarDataAdministrativa = orderBy($scope.listarDataAdministrativa, predicate, reverse);
            };
            $scope.order('bimester', false);

            $scope.listarAdministracion = function () {
                if (localStorageService.length() != 0) {
                    $http({
                        url: server.serverUrl + '/api/bimesters',
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        for (var x = 0; x < data.data.length; x++) {

                            var date = new Date(data.data[x].start_timestamp * 1000);
                            var dateFinish = new Date(data.data[x].end_timestamp * 1000)
                            var start_timestamp = $scope.meses[date.getMonth()] + " " + date.getDate() + ", " + date.getFullYear();
                            var end_timestamp = $scope.meses[dateFinish.getMonth()] + " " + dateFinish.getDate() + ", " + dateFinish.getFullYear();

                            $scope.listarDataAdministrativa.push({
                                bimester_number: data.data[x].id,
                                start_timestamp: start_timestamp,
                                end_timestamp: end_timestamp,
                            })

                        }
                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });
                }
            }

            $scope.editarIndicadores = function (id) {
                $http({
                    url: server.serverUrl + '/api/bimesters/' + id,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    var date = new Date(data.data.start_timestamp * 1000);
                    var dateFinish = new Date(data.data.end_timestamp * 1000)
                    var start_timestamp = date.getFullYear() + "/" + date.getMonth() + "/" + date.getDate();
                    var end_timestamp = dateFinish.getFullYear() + "/" + dateFinish.getMonth() + "/" + dateFinish.getDate();
                    $scope.editar = {
                        id: data.data.id,
                        start_timestamp: start_timestamp,
                        end_timestamp: end_timestamp,
                    };
                    $scope.editarAdministrarModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }

            $scope.animationsEnabled = true;

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
            $scope.toggleAnimation = function () {
                $scope.animationsEnabled = !$scope.animationsEnabled;
            };

        })
        .controller('InstanciaIndicador', function ($scope, $uibModalInstance, items, $http, loginServices, localStorageService, server) {

            $scope.editar = items;

            $scope.editarAdministracion = function () {
                $http({
                    url: server.serverUrl + '/api/bimesters/' + $scope.editar.id,
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "start_timestamp=" + new Date() + "&end_timestamp=" + new Date() + "&username=" + localStorageService.get('usuario')
                }).success(function (data) {
                    if (data) {
                        $scope.listarAsignaciones = data.data;
                    }
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    } else if (error.error) {
                        $scope.erroresInsertarAsignacion = [];
                        $scope.erroresInsertarAsignacion.push({tipoError: 'Todos los campos son requeridos.'})
                    }
                });
            }
            /*cancel: cierra el modal*/
            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };
        })