'use strict';
angular.module('servicios', ['LocalStorageModule'])
        .service('loginServices', function ($http, localStorageService, server) {
            var self = this;
            self.allocations = [];
            self.allocationsNotRepeated = [];
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
                        for (var x = 0; x < data.allocations.length; x++) {
                            if (self.allocations.indexOf(data.allocations[x].group.id) == -1) {
                                self.allocations.push({
                                    id_grupo: data.allocations[x].group.id,
                                    grado: data.allocations[x].grade.grade_number,
                                    grupo: data.allocations[x].group.group_name
                                });
                            }
                        }

                        localStorageService.set('asignaciones', self.arrUnique(self.allocations));
                        self.guardarSession();
                    }

                }).error(function (error, status, headers, config) {
                    self.salirSession();
                });
            }
            self.arrUnique = function (arr) {
                var cleaned = [];
                self.allocations.forEach(function (itm) {
                    var unique = true;
                    cleaned.forEach(function (itm2) {
                        if (_.isEqual(itm, itm2))
                            unique = false;
                    });
                    if (unique)
                        cleaned.push(itm);
                });
                return cleaned;
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
                    url: 'logOut',
                    method: "get",
                }).success(function (data) {
                    localStorageService.clearAll();
                    location.reload();
                })
            }

        })
        .factory('server', function () {
            return {
                serverUrl: 'http://nkubunt.cloudapp.net:3000'
            };
        });