var app = angular.module('myApp', ['ngRoute']);
app.controller('clientsCtrl', function ($scope, $http) {
    $scope.showAddClientForm = function () {
        // clear form
        $scope.clearForm();
    }
    $scope.clearForm = function () {
        $scope.id = "";
        $scope.firstname = "";
        $scope.lastname = "";
    }
    $scope.getAll = function () {
        $http.get("read_clients.php").success(function (response) {
            $scope.clients = response.records;
        });
    }
    $scope.addClient = function () {
        // fields in key-value pairs
        $http.post('create_client.php', {
            'firstname': $scope.firstname
            , 'lastname': $scope.lastname
        }).success(function (data, status, headers, config) {
            console.log(data);
            // tell the user new client was created
            Materialize.toast(data, 4000);
            // close modal
            $('#modal-client-form').closeModal();
            // clear modal content
            $scope.clearForm();
            // refresh the list
            $scope.getAll();
        });
    }
});