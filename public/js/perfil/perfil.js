'use strict';
angular.module('perfil', ['ui.bootstrap', 'LocalStorageModule', 'servicios'])
        .controller('informacionPerfil', function ($scope, localStorageService, $http, loginServices) {

            $scope.perfil = {};
            if (localStorageService.length() != 0) {
                $http({
                    url: 'http://nkubunt.cloudapp.net:3000/api/account/me',
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    if (data) {
                        $scope.perfil.email = data.email;
                        $scope.perfil.telefono = data.contact_number;
                        $scope.perfil.nombre = data.first_name;
                        $scope.perfil.apellido_paterno = data.last_name;
                        $scope.perfil.puesto = data.user.role;
                    }
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    }
                })
            }else{
                loginServices.salirSession();
            }

        })