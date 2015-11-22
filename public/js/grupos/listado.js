'use strict';
angular.module('grupos', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('listado', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {
            
            $scope.listarGrupo = [];
            $scope.editar = [];
            /*orderBy: ordena los grupos por los campos seleccionados*/
            var orderBy = $filter('orderBy');
            $scope.order = function (predicate, reverse) {
                $scope.listarGrupo = orderBy($scope.listarGrupo, predicate, reverse);
            };
            $scope.order('first_name', false);
            /*listarGrupos: lista todos los grupos registrados*/
            $scope.listarGrupos = function () {
                if (localStorageService.length() != 0) {
                    /*ESTA API DEBE CAMBIARSE POR LOS GRUPOS EXISTENTES*/
                    $http({
                        url: server.serverUrl + '/api/school-groups',
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        $scope.listarGrupo = data.data;
                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });
                }
            }

            $scope.borrarGrupo = function (id) {
                console.log(id);
            }
            /*editarGrupo: edita el Grupo seleccionado, se envia el ID y se manda al modalInstanse el objeto del Grupo*/
            $scope.editarGrupo = function (id) {
                $http({
                    url: server.serverUrl + '/api/school-groups/' + id,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.editar = data.data;
                    $scope.editarGrupoModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }

            /*recuperarPasswordGrupo: edita el password de un Grupo seleccionado, se envia el ID y se manda al modalInstanse el objeto del Grupo*/


            $scope.animationsEnabled = true;

            /*agregarGrupoModal: abre el modal para agregar un Grupo*/
            $scope.agregarGrupoModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'agregarGrupo',
                    controller: 'InstanciaGrupo',
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

            /*editarGrupoModal: abre el modal para editar un Grupo, se envia en items el objeto posteriormente creado en editarGrupo*/
            $scope.editarGrupoModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'editarGrupo',
                    controller: 'InstanciaGrupo',
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
        /*InstanciaGrupo: funcionalidad de todos los modals para crear o editar un Grupo*/
        .controller('InstanciaGrupo', function ($scope, $uibModalInstance, items, $http, loginServices, localStorageService, server) {
            $scope.grupo = {};
            $scope.grupo.grade_number = '1';
            $scope.editar = items;
            $scope.recuperarPassword = items;
            $scope.listargrupo = [];
            
            setTimeout(function () {
                $('.form-control').keyup(function () {
                    if (this.value.match(/[^A-Z ]/g)) {
                        this.value = this.value.replace(/[^A-Z ]/g, '');
                    }
                });

            }, 100)

            /*guardar: guarda un grupo enviando los parametros a continuación*/
            $scope.guardarGrupo = function () {
                $http({
                    url: server.serverUrl + '/api/school-groups',
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "grade_number=" + $scope.grupo.grade_number + "&group_name=" + $scope.grupo.group_name.toUpperCase()
                }).success(function (data) {
                    if (data) {
                        swal({
                            title: "Éxito",
                            text: "El grupo " + $scope.grupo.grade_number + " " + $scope.grupo.group_name.toUpperCase() + " ha sido agregado correctamente",
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
                        $scope.erroresInsertarGrupo = [];
                        $scope.erroresInsertarGrupo.push({tipoError: 'El grupo ya se encuentra activo.'})
                    }
                });
            }

            /*guardar: edita un Grupo enviando los parametros a continuación*/
            $scope.guardarEditar = function () {
                $http({
                    url: server.serverUrl + '/api/school-groups/' + $scope.editar.id,
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "group_name=" + $scope.editar.group_name 
                }).success(function (data) {
                    if (data) {
                        swal({
                            title: "Éxito",
                            text: "El grupo " + $scope.editar.grade_id + "º ha sido editado correctamente",
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
                        $scope.erroresInsertarGrupo = [];
                        $scope.erroresInsertarGrupo.push({tipoError: error.message})
                    }
                });
            }

            /*cancel: cierra el modal*/
            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };
        })