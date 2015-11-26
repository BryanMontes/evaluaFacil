angular.module('reportes', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('llenadoReportes', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {
            $scope.asistencias = [];
            $scope.participacion = [];
            $scope.desempeno = [];
            $scope.lectora = [];
            $scope.matematica = [];
            $scope.actitud = [];
            $scope.bimestres = [];
            $scope.bimestreId = 0;
            $scope.grupoId = 0;
            $scope.grupos = [];
            $scope.graficaAsistencias = [];
            $scope.graficaParticipacion = [];
            $scope.graficaDesempeno = [];
            $scope.graficaLectora = [];
            $scope.graficaMatematica = [];
            $scope.graficaActitud = [];
            $scope.cargando = false;
            $scope.llenadoInformacion = function () {
                $http({
                    url: server.serverUrl + '/api/bimesters',
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {

                    for (var x = 0; x < data.data.length; x++) {
                        var bimestreStart = new Date(data.data[x].start_timestamp * 1000);
                        var bimestreFinish = new Date(data.data[x].end_timestamp * 1000);
                        var fechaActual = new Date();
                        if (fechaActual >= bimestreStart && fechaActual <= bimestreFinish) {
                            $scope.bimestreId = data.data[x].id;
                            setTimeout(function () {
                                $("#bimestre").val($scope.bimestreId);
                            }, 1000);

                            $scope.bimestres = data.data;
                        }
                    }
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
                $http({
                    url: server.serverUrl + '/api/school-groups',
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.grupos = data.data;
                    $scope.grupoId = data.data[0].id;
                    setTimeout(function () {
                        $("#grupo").val(data.data[0].id);
                        $scope.traerEspecifico();
                    }, 1000);
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }

            $scope.traerEspecifico = function () {
                $scope.cargando = true;
                $http({
                    url: server.serverUrl + '/api/reports/bimester/' + $scope.bimestreId + '/group/' + $scope.grupoId,
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    $scope.asistencias = data.data.absences[0];
                    $scope.participacion = data.data.participation[0];
                    $scope.desempeno = data.data.performance[0];
                    $scope.lectora = data.data.reading[0];
                    $scope.matematica = data.data.math[0];
                    $scope.actitud = data.data.friendship[0];
                    $scope.llenadoGraficas();
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                });
            }

            $scope.getRandomColor = function () {
                var letters = '0123456789ABCDEF'.split('');
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
            $scope.llenadoGraficas = function () {
                $scope.cargando = false;
                $scope.graficaAsistencias = [];
                $scope.graficaParticipacion = [];
                $scope.graficaDesempeno = [];
                $scope.graficaLectora = [];
                $scope.graficaMatematica = [];
                $scope.graficaActitud = [];
                for (var x = 1; x < $scope.asistencias.length; x++) {
                    $scope.graficaAsistencias.push({
                        value: ($scope.asistencias[x].ratio * 100).toFixed(2),
                        color: $scope.getRandomColor(),
                        highlight: $scope.getRandomColor(),
                        label: $scope.asistencias[x].item
                    });
                }

                for (var x = 1; x < $scope.participacion.length; x++) {
                    $scope.graficaParticipacion.push({
                        value: ($scope.participacion[x].ratio * 100).toFixed(2),
                        color: $scope.getRandomColor(),
                        highlight: $scope.getRandomColor(),
                        label: $scope.participacion[x].item
                    });
                }

                for (var x = 1; x < $scope.desempeno.length; x++) {
                    $scope.graficaDesempeno.push({
                        value: ($scope.desempeno[x].ratio * 100).toFixed(2),
                        color: $scope.getRandomColor(),
                        highlight: $scope.getRandomColor(),
                        label: $scope.desempeno[x].item
                    });
                }

                for (var x = 1; x < $scope.lectora.length; x++) {
                    $scope.graficaLectora.push({
                        value: ($scope.lectora[x].ratio * 100).toFixed(2),
                        color: $scope.getRandomColor(),
                        highlight: $scope.getRandomColor(),
                        label: $scope.lectora[x].item
                    });
                }

                for (var x = 1; x < $scope.matematica.length; x++) {
                    $scope.graficaMatematica.push({
                        value: ($scope.matematica[x].ratio * 100).toFixed(2),
                        color: $scope.getRandomColor(),
                        highlight: $scope.getRandomColor(),
                        label: $scope.matematica[x].item
                    });
                }

                for (var x = 1; x < $scope.actitud.length; x++) {
                    $scope.graficaActitud.push({
                        value: ($scope.actitud[x].ratio * 100).toFixed(2),
                        color: $scope.getRandomColor(),
                        highlight: $scope.getRandomColor(),
                        label: $scope.actitud[x].item
                    });
                }

                var asistencia = document.getElementById("asistencia").getContext("2d");
                var participacion = document.getElementById("participacion").getContext("2d");
                var desempeno = document.getElementById("desempeno").getContext("2d");
                var lectora = document.getElementById("lectora").getContext("2d");
                var matematica = document.getElementById("matematica").getContext("2d");
                var escolar = document.getElementById("escolar").getContext("2d");
                window.myPie = new Chart(asistencia).Pie($scope.graficaAsistencias);
                window.myPie = new Chart(participacion).Pie($scope.graficaParticipacion);
                window.myPie = new Chart(desempeno).Pie($scope.graficaDesempeno);
                window.myPie = new Chart(lectora).Pie($scope.graficaLectora);
                window.myPie = new Chart(matematica).Pie($scope.graficaMatematica);
                window.myPie = new Chart(escolar).Pie($scope.graficaActitud);
            }

        })
