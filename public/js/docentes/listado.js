'use strict';
angular.module('docentes', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('listado', function ($scope, localStorageService, $http, $uibModal, loginServices) {

            $scope.listarDocentes = function () {
                if (localStorageService.length() != 0) {

                    $http({
                        url: 'http://nkubunt.cloudapp.net:3000/api/faculty-members',
                        method: "GET",
                        headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        $scope.listarDocentes=data;

                    }).error(function (error, status, headers, config) {
                        if (error == "Unauthorized") {
                            loginServices.refrescarToken();
                        }
                    });






                }
            }
            $scope.animationsEnabled = true;

            $scope.agregarDocenteModal = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'agregarDocente',
                    controller: 'InstanciaDocente',
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
            };

            $scope.toggleAnimation = function () {
                $scope.animationsEnabled = !$scope.animationsEnabled;
            };
        })
        .controller('InstanciaDocente', function ($scope, $uibModalInstance, items) {

            $scope.items = items;
            $scope.selected = {
                item: $scope.items[0]
            };

            $scope.ok = function () {
                $uibModalInstance.close($scope.selected.item);
            };

            $scope.cancel = function () {
                $uibModalInstance.dismiss('cancel');
            };
        });