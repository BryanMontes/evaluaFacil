'use strict';
angular.module('alumnos', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('listado', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {

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
                        url: server.serverUrl + '/api/students/in-group/' + document.location.href.split("/")[document.location.href.split("/").length - 1],
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
                swal({
                    title: "Atención",
                    text: "¿Está seguro que desea dar de baja al alumno?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ok",
                    closeOnConfirm: true,
                }, function (isConfirm) {
                    if (isConfirm) {
                        $http({
                            url: server.serverUrl + '/api/students/' + id,
                            method: "DELETE",
                            headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                        }).success(function (data) {
                            swal({
                                title: "Éxito!",
                                text: "El alumno ha sido borrado correctamente",
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
            /*editarAlumno: edita el alumno seleccionado, se envia el ID y se manda al modalInstanse el objeto del alumno*/
            $scope.editarAlumno = function (id) {
                $http({
                    url: server.serverUrl + '/api/students/' + id,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.editar = data.data;
                    $scope.editarAlumnoModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }


            $scope.animationsEnabled = true;

            /*agregarAlumnoModal: abre el modal para agregar un alumno*/
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

            /*editarAlumnoModal: abre el modal para editar un alumno, se envia en items el objeto posteriormente creado en editarAlumno*/
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
        /*InstanciaAlumno: funcionalidad de todos los modals para crear o editar un alumno*/
        .controller('InstanciaAlumno', function ($scope, $uibModalInstance, items, $http, loginServices, localStorageService, server) {


            $scope.alumno = {};
            $scope.alumno.school_group_id = document.location.href.split("/")[document.location.href.split("/").length - 1];
            $scope.alumno.gender = "M";
            $scope.editar = items;
            $scope.listarAlumno = [];


            setTimeout(function () {
                $('.form-control').keyup(function () {
                    if (this.value.match(/[^A-Z ]/g)) {
                        this.value = this.value.replace(/[^A-Z ]/g, '');
                    }
                });

            }, 100)
            /*guardar: guarda un alumno enviando los parametros a continuación*/
            $scope.guardar = function () {
                $http({
                    url: server.serverUrl + '/api/students/',
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "first_name=" + $scope.alumno.first_name + "&last_name=" + $scope.alumno.last_name + "&mothers_name=" + $scope.alumno.mothers_name +
                            "&school_group_id=" + $scope.alumno.school_group_id + "&gender=" + $scope.alumno.gender
                }).success(function (data) {
                    if (data) {
                        swal({
                            title: "Éxito",
                            text: "El alumno " + $scope.alumno.first_name + " ha sido agregado correctamente",
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

            /*guardar: edita un alumno enviando los parametros a continuación*/
            $scope.guardarEditar = function () {
                $http({
                    url: server.serverUrl + '/api/students/' + $scope.editar.id,
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "first_name=" + $scope.editar.first_name + "&last_name=" + $scope.editar.last_name + "&mothers_name=" + $scope.editar.mothers_name +
                            "&school_group_id=" + $scope.editar.school_group_id + "&gender=" + $scope.editar.gender
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