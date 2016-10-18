var app = angular.module('myApp', ['ui.router', 'ngSanitize']);
app.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/clients');
    $stateProvider.state('clients', {
        url: '/clients'
        , templateUrl: 'clients.html'
        , controller: 'clientsCtrl'
    }).state('accounts', {
        url: '/accounts'
        , params: {
            clientId: null
        }
        , templateUrl: 'accounts.html'
        , controller: 'accountsCtrl'
    });
});
app.controller('clientsCtrl', function ($scope, $http, $state) {
    $scope.showAddClientForm = function () {
        // clear form
        $scope.clearForm();
        // open modal
        $('#modal-client-form').openModal();
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
    $scope.selectClient = function (id) {
        $state.go('accounts', {
            clientId: id
        });
    }
});
app.controller('accountsCtrl', function ($scope, $http, $state, $stateParams) {
    $scope.clientId = $stateParams.clientId;
    $scope.currencyMap = {
        "euro": "&euro;"
        , "dollar": "$"
        , "pound": "&pound;"
        , "yen": "&yen;"
    };
    $scope.typeMap = {
        "checking": "Checking"
        , "savings": "Savings"
    };
    $scope.showAccountCreateForm = function () {
        $('select').material_select();
        // clear form
        $scope.clearForm();
        // change modal title
        $('#modal-account-title').text("Create New Account");
        // hide update account button
        $('#btn-update-account').hide();
        // show create account button
        $('#btn-create-account').show();
        // open modal
        $('#modal-account-form').openModal();
    }
    $scope.clearForm = function () {}
    $scope.getAll = function () {
        $http.get("read_accounts.php", {
            params: {
                'clientId': $scope.clientId
            }
        }).success(function (data, status) {
            $scope.accounts = data.records;
        });
    }
    $scope.goBack = function () {
        $state.go("clients");
    }
    $scope.createAccount = function (id) {
        $http.post('create_account.php', {
            'clientId': $scope.clientId
            , 'iban': $scope.iban
            , 'type': $scope.type
            , 'currency': $scope.currency
            , 'amount': $scope.amount
        }).success(function (data, status, headers, config) {
            console.log(data);
            // tell the user new account was created
            Materialize.toast(data, 4000);
            // close modal
            $('#modal-account-form').closeModal();
            // clear modal content
            $scope.clearForm();
            // refresh the list
            $scope.getAll();
        });
    }
    $scope.editAccount = function (id) {
        // change modal title
        $('#modal-account-title').text("Edit Account");
        // show udpate account button
        $('#btn-update-account').show();
        // show create account button
        $('#btn-create-account').hide();
        // post id of account to be edited
        $http.post('read_one_account.php', {
            'id': id
        }).success(function (data, status, headers, config) {
            // put the values in form
            $scope.id = data[0]["id"];
            $scope.iban = data[0]["iban"];
            $scope.type = data[0]["type"];
            $scope.currency = data[0]["currency"];
            $scope.amount = data[0]["amount"];
            // show modal
            $('#modal-account-form').openModal();
        }).error(function (data, status, headers, config) {
            Materialize.toast('Unable to retrieve record.', 4000);
        });
    }
});