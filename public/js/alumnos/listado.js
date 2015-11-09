'use strict';
angular.module('alumnos', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('listado', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter) {

            $scope.listarAlumno = [];
            $scope.editar = [];

            /*orderBy: ordena los alumnos por los campos seleccionados*/
            var orderBy = $filter('orderBy');
            $scope.order = function (predicate, reverse) {
                $scope.listarAlumno = orderBy($scope.listarAlumno, predicate, reverse);
            };
            $scope.order('first_name', false);
            /*listarAlumnos: lista todos los alumnos registrados*/
            $scope.listarAlumnos = function () {
                if (localStorageService.length() != 0) {
//                    $scope.id_group
                    $http({
                        url: 'http://nkubunt.cloudapp.net:3000/api/students/in-group/' + 1,
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        $scope.listarAlumno = data.data;
                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });
                }
            }

            $scope.borrarAlumno = function (id) {
                console.log(id);
            }
            /*editarAlumno: edita el docente seleccionado, se envia el ID y se manda al modalInstanse el objeto del docente*/
            $scope.editarAlumno = function (id) {
                $http({
                    url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members/' + id,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.editar = data;
                    $scope.editarAlumnoModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }


            $scope.animationsEnabled = true;

            /*agregarAlumnoModal: abre el modal para agregar un docente*/
            $scope.agregarAlumnoModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'agregarAlumno',
                    controller: 'InstanciaAlumno',
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

            /*editarAlumnoModal: abre el modal para editar un docente, se envia en items el objeto posteriormente creado en editarAlumno*/
            $scope.editarAlumnoModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'editarAlumno',
                    controller: 'InstanciaAlumno',
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
        /*InstanciaAlumno: funcionalidad de todos los modals para crear o editar un docente*/
        .controller('InstanciaAlumno', function ($scope, $uibModalInstance, items, $http, loginServices, localStorageService) {
            $scope.docente = {};
            $scope.docente.rol = "teacher";
            $scope.editar = items;
            $scope.listarAlumno = [];

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
                            $scope.erroresInsertarAlumno = [];
                            $scope.erroresInsertarAlumno.push({tipoError: 'Todos los campos son requeridos.'})
                        }
                    });
                } else {
                    $scope.erroresInsertarAlumno = [];
                    $scope.erroresInsertarAlumno.push({tipoError: 'Las contraseñas no coinciden.'})
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
                        $scope.erroresInsertarAlumno = [];
                        $scope.erroresInsertarAlumno.push({tipoError: 'Todos los campos son requeridos.'})
                    }
                });
            }

            /*cancel: cierra el modal*/
            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };
        })