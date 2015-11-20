angular.module('loginRegister', ['ui.bootstrap', 'LocalStorageModule', 'servicios'])
        .controller('iniciarSesion', function ($scope, $uibModal, $http, localStorageService, loginServices, server) {
            $scope.animationsEnabled = true;


            $scope.iniciarS = function (size) {

                var modalInstance = $uibModal.open({
                    animation: $scope.animationsEnabled,
                    templateUrl: 'inicioSesion',
                    controller: 'ModalInstanceCtrl',
                    size: size,
                    resolve: {
                        items: function () {
                            return ':)';
                        }
                    }
                });

                modalInstance.result.then(function (selectedItem) {
                    $scope.selected = selectedItem;
                })
            };
            $scope.toggleAnimation = function () {
                $scope.animationsEnabled = !$scope.animationsEnabled;
            }
            $scope.salir = function () {
                loginServices.salirSession();
            }
        })
        .controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, $http, items, localStorageService, loginServices, server) {
            $scope.sesion = {};
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


            $scope.ingresar = function () {
                if ($scope.sesion.usuario != undefined && $scope.sesion.password != undefined) {

                    $http({
                        url: server.serverUrl + '/oauth/token',
                        method: "POST",
                        data: "grant_type=password&username=" + $scope.sesion.usuario + "&password=" + $scope.sesion.password,
                        headers: {'Authorization': 'Basic d2ViY2xpZW50OnBhc3N3b3Jk',
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}
                    }).success(function (data) {
                        if (localStorageService.isSupported) {
                            localStorageService.clearAll();
                            localStorageService.set("session", data);
                            localStorageService.set("usuario", $scope.sesion.usuario);
                            loginServices.tipoUsuario();
                        }

                    }).error(function (error, status, headers, config) {
                        $scope.erroresIniciarS = [];
                        $scope.erroresIniciarS.push({tipoError: 'Usuario o contraseña no valida.'})
                    });

                } else {
                    $scope.erroresIniciarS = [];
                    $scope.erroresIniciarS.push({tipoError: 'Ingresa tu usuario y tu contraseña antes de continuar'})
                }

            }

        })
        