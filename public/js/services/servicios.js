'use strict';
angular.module('servicios', ['LocalStorageModule'])
        .service('loginServices', function ($http, localStorageService, server) {
            var self = this;
            self.refrescarToken = function () {
                console.log('entró a refrescar token');
                $http({
                    url: server.serverUrl + '/oauth/token',
                    method: "POST",
                    data: "grant_type=refresh_token&refresh_token=" + localStorageService.get('session').refresh_token,
                    headers: {'Authorization': 'Basic d2ViY2xpZW50OnBhc3N3b3Jk',
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    if (localStorageService.isSupported) {
                        localStorageService.set("session", data);
                        self.tipoUsuario();

                    }

                }).error(function (error, status, headers, config) {
                    self.salirSession();
                });
            }

            self.tipoUsuario = function () {
                $http({
                    url: server.serverUrl + '/api/account/me',
                    method: "GET",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                }).success(function (data) {
                    if (localStorageService.isSupported) {
                        localStorageService.set('userType', data.user.role);
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
                        usuario: localStorageService.get('usuario'),
                        access_token: localStorageService.get('session').access_token,
                        refresh_token: localStorageService.get('session').refresh_token,
                        tipoUsuario: localStorageService.get('userType')
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
                    localStorageService.clearAll();
                    if (data.status)
                        location.reload();
                })
            }
            self.mensaje = function () {
                console.log('wiiii');
            }

        })
        .factory('server', function () {
            return {
                serverUrl: 'http://nkubunt.cloudapp.net:3000'
            };
        });