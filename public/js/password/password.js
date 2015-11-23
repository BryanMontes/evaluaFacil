angular.module('password', ['ui.bootstrap', 'LocalStorageModule', 'ngAnimate', 'servicios'])
        .controller('cambiarPassword', function ($scope, localStorageService, $http, $uibModal, loginServices, $filter, server) {
            $scope.password = {};
            $scope.erroresInsertarDocente = [];
            
            $scope.cambiarPass = function () {
                $http({
                    url: server.serverUrl + '/api/account/change-password',
                    method: "PUT",
                    headers: {'Authorization': 'Bearer ' + localStorageService.get("session").access_token,
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'},
                    data: "current_password=" + $scope.password.anterior + "&new_password=" + $scope.password.nueva + "&confirm_password=" + $scope.password.repetirPassword
                }).success(function (data) {
                    if(data.success){
                        location.reload();
                    }
                }).error(function (error, status, headers, config) {
                    if (error == "Unauthorized") {
                        loginServices.refrescarToken();
                    } else if (error.error) {
                        $scope.erroresInsertarDocente = [];
                        $scope.erroresInsertarDocente.push({tipoError: 'Todos los campos son requeridos.'})
                    }
                });
            }

        })
