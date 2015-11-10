'use strict';
angular.module('perfil', ['ui.bootstrap', 'LocalStorageModule', 'servicios'])
        .controller('informacionPerfil', function ($scope, localStorageService, $http, loginServices,server) {

            $scope.perfil = {};
            if (localStorageService.length() != 0) {
                $http({
                    url: server.serverUrl + '/api/account/me',
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    if (data) {
                        $scope.perfil = data;
                    }
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                })
            } else {
                loginServices.salirSession();
            }

            $scope.editarPerfil = function () {
                $http({
                    url: server.serverUrl + '/api/faculty-members/' + $scope.perfil.id,
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "first_name=" + $scope.perfil.first_name + "&last_name=" + $scope.perfil.last_name +
                            "&email=" + $scope.perfil.email + "&contact_number=" + $scope.perfil.contact_number +
                            "&title="+$scope.perfil.title
                }).success(function (data) {
                    if (data) {
                        swal({
                            title: "Éxito",
                            text: "Tus cambios han sido modificados correctamente.",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: "Ok",
                            closeOnConfirm: true,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        })
                    }
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                })
            }

        })