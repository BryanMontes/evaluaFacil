'use strict';
angular.module('docentes', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('listado', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter) {

            $scope.listarDocente = [];
            $scope.editar = [];
            /*orderBy: ordena los docentes por los campos seleccionados*/
            var orderBy = $filter('orderBy');
            $scope.order = function (predicate, reverse) {
                $scope.listarDocente = orderBy($scope.listarDocente, predicate, reverse);
            };
            $scope.order('first_name', false);
            /*listarDocentes: lista todos los docentes registrados*/
            $scope.listarDocentes = function () {
                if (localStorageService.length() != 0) {

                    $http({
                        url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members',
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        $scope.listarDocente = data;
                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });
                }
            }

            $scope.borrarDocente = function (id) {
                console.log(id);
            }
            /*editarDocente: edita el docente seleccionado, se envia el ID y se manda al modalInstanse el objeto del docente*/
            $scope.editarDocente = function (id) {
                $http({
                    url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members/' + id,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.editar = data;
                    $scope.editarDocenteModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }

            /*recuperarPasswordDocente: edita el password de un docente seleccionado, se envia el ID y se manda al modalInstanse el objeto del docente*/
            $scope.recuperarPasswordDocente = function (id) {
                $http({
                    url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members/' + id,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.editar = data;
                    $scope.recuperarPasswordDocenteModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }

            $scope.animationsEnabled = true;

            /*agregarDocenteModal: abre el modal para agregar un docente*/
            $scope.agregarDocenteModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'agregarDocente',
                    controller: 'InstanciaDocente',
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

            /*editarDocenteModal: abre el modal para editar un docente, se envia en items el objeto posteriormente creado en editarDocente*/
            $scope.editarDocenteModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'editarDocente',
                    controller: 'InstanciaDocente',
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

            /*recuperarPasswordDocenteModal: abre el modal para recuperar la clave de un docente, se envia en items el objeto posteriormente creado en recuperarPasswordDocente*/
            $scope.recuperarPasswordDocenteModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'recuperarPasswordDocente',
                    controller: 'InstanciaDocente',
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
        /*InstanciaDocente: funcionalidad de todos los modals para crear o editar un docente*/
        .controller('InstanciaDocente', function ($scope, $uibModalInstance, items, $http, loginServices, localStorageService) {
            $scope.docente = {};
            $scope.docente.rol = "teacher";
            $scope.editar = items;
            $scope.recuperarPassword = items;
            $scope.listarDocente = [];

            /*guardar: guarda un docente enviando los parametros a continuación*/
            $scope.guardar = function () {
                if ($scope.docente.contrasena == $scope.docente.confirmContrasena) {
                    $http({
                        url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members',
                        method: "PUT",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                        data: "first_name=" + $scope.docente.nombre + "&last_name=" + $scope.docente.apellido + "&email=" + $scope.docente.email + "&contact_number=" + $scope.docente.telefono +
                                "&username=" + $scope.docente.usuario + "&password=" + $scope.docente.contrasena + "&title=Ing.&role_title=" + $scope.docente.rol
                    }).success(function (data) {
                        if (data) {
                            swal({
                                title: "Éxito",
                                text: "El usuario " + $scope.docente.nombre + " ha sido agregado correctamente",
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
                            $scope.erroresInsertarDocente = [];
                            $scope.erroresInsertarDocente.push({tipoError: 'Todos los campos son requeridos.'})
                        }
                    });
                } else {
                    $scope.erroresInsertarDocente = [];
                    $scope.erroresInsertarDocente.push({tipoError: 'Las contraseñas no coinciden.'})
                }

            }

            /*guardar: edita un docente enviando los parametros a continuación*/
            $scope.guardarEditar = function () {
                $http({
                    url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members/' + $scope.editar.id,
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "first_name=" + $scope.editar.first_name + "&last_name=" + $scope.editar.last_name +
                            "&email=" + $scope.editar.email + "&contact_number=" + $scope.editar.contact_number +
                            "&title=Ing."
                }).success(function (data) {
                    if (data) {
                        swal({
                            title: "Éxito",
                            text: "El usuario " + $scope.editar.first_name + " ha sido editado correctamente",
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
                        $scope.erroresInsertarDocente = [];
                        $scope.erroresInsertarDocente.push({tipoError: 'Todos los campos son requeridos.'})
                    }
                });
            }

            /*recuperarPasswordDocente: se restaura la contraseña del docente seleccionado*/
            $scope.recuperarPasswordDocente = function () {
                if ($scope.recuperarPassword.nuevoPassword == $scope.recuperarPassword.confirmarPassword) {
                    $http({
                        url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members/' + $scope.recuperarPassword.id,
                        method: "PUT",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                        data: "new_password=" + $scope.recuperarPassword.nuevoPassword
                    }).success(function (data) {
                        if (data) {
                            swal({
                                title: "Éxito",
                                text: "El usuario " + $scope.editar.first_name + " ha sido editado correctamente",
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
                            $scope.erroresInsertarDocente = [];
                            $scope.erroresInsertarDocente.push({tipoError: 'Todos los campos son requeridos.'})
                        }
                    });
                } else {
                    $scope.erroresInsertarDocente = [];
                    $scope.erroresInsertarDocente.push({tipoError: 'Las contraseñas no coinciden.'})
                }
            }
            /*cancel: cierra el modal*/
            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };
        })