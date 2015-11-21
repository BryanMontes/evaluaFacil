angular.module('evaluaciones', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('captura_evaluaciones', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {

            $scope.listarEvaluacion = [];
            $scope.arregloLocal = localStorageService.get('asignaciones');
            $scope.evaluar = [];


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

            /*evaluarAlumno: edita el alumno seleccionado, se envia el ID y se manda al modalInstanse el objeto del alumno*/
            $scope.evaluarAlumno = function (id) {
                $http({
                    url: server.serverUrl + '/api/students/' + id,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.evaluar = data.data;
                    $scope.evaluarAlumnoModal();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }

            $scope.animationsEnabled = true;

            /*editarAlumnoModal: abre el modal para editar un alumno, se envia en items el objeto posteriormente creado en editarAlumno*/
            $scope.evaluarAlumnoModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'evaluarAlumno',
                    controller: 'InstanciaAlumno',
                    size: size,
                    resolve: {
                        items: function () {
                            return $scope.evaluar;
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

            
            $scope.alumno = items;
            
            $scope.listarAlumno = [];

            /*evaluar: evaluar un alumno enviando los parametros a continuación*/
            $scope.evaluar = function () {
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
                            text: "El alumno " + $scope.alumno.first_name + " ha sido evaluado correctamente",
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