angular.module('seleccionBimestre', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('seleccion', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {
            $scope.evaluar = [];
            $scope.arregloMateria = [];
            $scope.materia = [];
            $scope.idMateria = 0;

            $scope.arregloMaterias = function () {
                $http({
                    url: server.serverUrl + '/api/evaluations/current/group/pending/' + document.location.href.split("/")[document.location.href.split("/").length - 1],
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    for (var x = 0; x < data.data.length; x++) {
                        if (data.data[x].id == document.location.href.split("/")[document.location.href.split("/").length - 2]) {
                            if (data.data[x].missing.length != 0) {
                                $scope.arregloMateria = data.data[x];
                            }else{
                                window.location.href = "/evaluaciones";
                            }
                        }

                    }
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                })
            }

            /*evaluarAlumno: edita el alumno seleccionado, se envia el ID y se manda al modalInstanse el objeto del alumno*/
            $scope.evaluarAlumno = function (idAlumno, idMateria) {
                $http({
                    url: server.serverUrl + '/api/students/' + idAlumno,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.evaluar = data.data;
                    $scope.idMateria = idMateria;
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
                        },
                        idMateria: function () {
                            return $scope.idMateria;
                        },
                        nombreMateria: function () {
                            return $(".active").html().split(">")[1].replace(/ /g, "").split("<")[0].replace("\n", "");
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
            /*
             * $scope.formControl = function () {
             if (this.value.match(/[^0-9 ]/g)) {
             this.value = this.value.replace(/[^0-9 ]/g, '');
             }
             }
             */



        })
        /*InstanciaAlumno: funcionalidad de todos los modals para crear o editar un alumno*/
        .controller('InstanciaAlumno', function ($scope, $uibModalInstance, items, nombreMateria, idMateria, $http, loginServices, localStorageService, server) {
            $scope.bimestres = [];
            $scope.alumno = items;
            $scope.nombreMateria = nombreMateria;
            $scope.idMateria = idMateria;
            $scope.listarAlumno = [];
            setTimeout(function () {
                $('.form-control').keyup(function () {
                    if (this.value.match(/[^0-9 ]/g)) {
                        this.value = this.value.replace(/[^0-9 ]/g, '');
                    }
                });

            }, 100)
            $scope.bimestreActual = function () {
                $http({
                    url: server.serverUrl + '/api/bimesters',
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                }).success(function (data) {
                    for (var x = 0; x < data.data.length; x++) {
                        var bimestreStart = new Date(data.data[x].start_timestamp * 1000);
                        var bimestreFinish = new Date(data.data[x].end_timestamp * 1000);
                        var fechaActual = new Date();
                        if (fechaActual >= bimestreStart && fechaActual <= bimestreFinish) {
                            $scope.evaluar(data.data[x].bimester_number)
                        }
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

            /*evaluar: evaluar un alumno enviando los parametros a continuación*/
            $scope.evaluar = function (bimestre) {
                $http({
                    url: server.serverUrl + '/api/evaluations/bimester/' + bimestre + '/student/' + $scope.alumno.id,
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "absences_count=" + $scope.alumno.absences_count + "&participation_score=" + $scope.alumno.participation_score + "&performance_score=" + $scope.alumno.performance_score +
                            "&reading_score=" + $scope.alumno.reading_score + "&math_score=" + $scope.alumno.math_score + "&friendship_score=" + $scope.alumno.friendship_score +
                            "&subject_id=" + idMateria
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
