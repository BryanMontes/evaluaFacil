'use strict';
angular.module('asignaciones', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios', 'checklist-model'])
        .controller('listado', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {

            $scope.listarAsignaciones = [];
            $scope.listarInfoDocente = {};
            $scope.editar = [];

            /*orderBy: ordena las asignaciones por los campos seleccionadas*/
            var orderBy = $filter('orderBy');
            $scope.order = function (predicate, reverse) {
                $scope.listarAsignaciones = orderBy($scope.listarAsignaciones, predicate, reverse);
            };
            $scope.order('first_name', false);
            /*listarAsignacion: lista todos las asignaciones registradas*/

            $http({
                url: server.serverUrl + '/api/faculty-members/' + document.location.href.split("/")[document.location.href.split("/").length - 1],
                method: "GET",
                headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
            }).success(function (data) {
                $scope.listarInfoDocente = data.data;
                $scope.listarAsignacion();
            }).error(function (error, status, headers, config) {
                if (error == "Unauthorized") {
                    loginServices.refrescarToken();
                }
            });


            $scope.listarAsignacion = function () {
                if (localStorageService.length() != 0) {

                    $http({
                        url: server.serverUrl + '/api/allocations/faculty-member/' + document.location.href.split("/")[document.location.href.split("/").length - 1],
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        $scope.listarAsignaciones = data.data;
                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });
                }
            }



            $scope.borrarAsignacion = function (id) {
                swal({
                    title: "Atención",
                    text: "¿Está seguro que desea quitar esta asignación?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ok",
                    closeOnConfirm: true,
                }, function (isConfirm) {
                    if (isConfirm) {
                        $http({
                            url: server.serverUrl + '/api/allocations/faculty-member/' + $scope.listarInfoDocente.id,
                            method: "DELETE",
                            headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                            data: "allocation_id=" + id
                        }).success(function (data) {
                            swal({
                                title: "Éxito!",
                                text: "La asignación ha sido borrada correctamente",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonText: "Ok",
                                closeOnConfirm: true,
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            })
                        }).error(function (error, status, headers, config) {
                            if (error == "Unauthorized") {
                                loginServices.refrescarToken();
                            }
                        });
                    }
                })

            }

            $scope.animationsEnabled = true;

            /*agregarAsignacionModal: abre el modal para agregar un asignacion*/
            $scope.agregarAsignacionModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'agregarAsignacion',
                    controller: 'InstanciaAsignacion',
                    size: size,
                    resolve: {
                        items: function () {
                            return ':)';
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
        /*InstanciaAsignacion: funcionalidad de todos los modals para crear o editar un asignacion*/
        .controller('InstanciaAsignacion', function ($scope, $uibModalInstance, items, $http, loginServices, localStorageService, server) {
            $scope.asignacion = {};
            $scope.asignacion.rol = "teacher";
            $scope.editar = items;
            $scope.recuperarPassword = items;
            $scope.asignacion.asignacionCheck = false;
            $scope.listarAsignaciones = [];
            $scope.asignaciones = [];
            $scope.asignacionDisponible = {
                ides: []
            }

            $http({
                url: server.serverUrl + '/api/allocations/available',
                method: "GET",
                headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                data: $scope.asignacion.ides
            }).success(function (data) {
                if (data) {
                    $scope.listarAsignaciones = data;
                }
            }).error(function (error, status, headers, config) {
                if (error == "Unauthorized") {
                    loginServices.refrescarToken();
                } else if (error.error) {
                    $scope.erroresInsertarAsignacion = [];
                    $scope.erroresInsertarAsignacion.push({tipoError: 'Todos los campos son requeridos.'})
                }
            });

            $scope.console = function () {
                $scope.asignaciones=[];
                for (var x = 0; x < $scope.asignacionDisponible.ides.length; x++) {
                    $scope.asignaciones.push({
                        grade_number: $scope.asignacionDisponible.ides[x].grade.id,
                        school_group_id: $scope.asignacionDisponible.ides[x].school_group.id,
                        subject_id: $scope.asignacionDisponible.ides[x].subject.id
                    })
                }

            }

            /*guardar: guarda un asignacion enviando los parametros a continuación*/
            $scope.guardar = function () {
                    $http({
                        url: server.serverUrl + '/api/allocations/faculty-member/' + document.location.href.split("/")[document.location.href.split("/").length - 1],
                        method: "PUT",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/json'},
                        data: angular.toJson($scope.asignaciones)
                    }).success(function (data) {
                        if (data) {
                            swal({
                                title: "Éxito",
                                text: "Las asignaciones del profesor han sido actualizadas",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonText: "Ok",
                                closeOnConfirm: true,
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    $uibModalInstance.close();
                                    location.reload();
                                }
                            })
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