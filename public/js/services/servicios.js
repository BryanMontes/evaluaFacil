'use strict';
angular.module('servicios', ['LocalStorageModule'])
        .service('loginServices', function ($http, localStorageService) {
            var self = this;
            self.refrescarToken = function () {
                console.log('entró a refrescar token');
                $http({
                    url: 'http://nkubunt.cloudapp.net:3000/oauth/token',
                    method: "POST",
                    data: "grant_type=refresh_token&refresh_token=" + localStorageService.get('session').refresh_token,
                    headers: {'Authorization': 'Basic d2ViY2xpZW50OnBhc3N3b3Jk',
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    if (localStorageService.isSupported) {
                        localStorageService.set("session", data);
                        self.guardarSession();
                        
                    }

                }).error(function (error, status, headers, config) {
                    self.salirSession();
                });
            }
            self.guardarSession = function () {

                $http({
                    url: 'login',
                    method: "POST",
                    data: {
                        "usuario": localStorageService.get('usuario'),
                        "access_token": localStorageService.get('session').access_token,
                        "refresh_token": localStorageService.get('session').refresh_token
                    },
                }).success(function (data) {
                    if (data.status) {
                        location.reload();
                    }
                })
            }

            self.salirSession = function () {
                localStorageService.remove('session');
                $http({
                    url: 'logOutSesionUsuario',
                    method: "PUT",
                }).success(function (data) {
                    if (data.status)
                        location.reload();
                })
            }
            self.mensaje = function () {
                console.log('wiiii');
            }
        })