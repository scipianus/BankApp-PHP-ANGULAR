<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-route.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
</head>

<body>
    <div class="container" ng-app="myApp" ng-controller="clientsCtrl">
        <div class="row">
            <div class="col s12">
                <h4>Clients</h4>
                <!-- used for searching the current list -->
                <input type="text" ng-model="search" class="form-control" placeholder="Search client..." />
                <!-- table that shows client record list -->
                <table class="hoverable bordered">
                    <thead>
                        <tr>
                            <th class="text-align-center">ID</th>
                            <th class="width-30-pct">First name</th>
                            <th class="width-30-pct">Last name</th>
                            <th class="text-align-center">Action</th>
                        </tr>
                    </thead>
                    <tbody ng-init="getAll()">
                        <tr ng-repeat="d in clients | filter:search">
                            <td class="text-align-center">{{ d.id }}</td>
                            <td>{{ d.firstname }}</td>
                            <td>{{ d.lastname }}</td>
                            <td> <a ng-click="selectClient(d.id)" class="waves-effect waves-light btn"><i class="material-icons left"></i>Select</a> </tr>
                    </tbody>
                </table>
                <!-- modal for adding a new client -->
                <div id="modal-client-form" class="modal">
                    <div class="modal-content">
                        <h4 id="modal-client-title">Add New Client</h4>
                        <div class="row">
                            <div class="input-field col s12">
                                <input ng-model="firstname" type="text" class="validate" id="form-name" placeholder="Type first name here..." />
                                <label for="firstname">First Name</label>
                            </div>
                            <div class="input-field col s12">
                                <input ng-model="lastname" type="text" class="validate" id="form-name" placeholder="Type last name here..." />
                                <label for="lastname">Last Name</label>
                            </div>
                            <div class="input-field col s12"> <a id="btn-add-client" class="waves-effect waves-light btn" ng-click="addClient()"><i class="material-icons left">add</i>Add</a> </div>
                        </div>
                    </div>
                </div>
                <!-- floating button for adding a new client -->
                <div class="fixed-action-btn" style="bottom:45px; right:24px;"> <a class="waves-effect waves-light btn modal-trigger btn-floating btn-large red" href="#modal-client-form" ng-click="showAddClientForm()"><i class="large material-icons">add</i></a> </div>
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
    <script>
        $(document).ready(function () {
            // initialize modal
            $('.modal-trigger').leanModal();
        });
    </script>
</body>

</html>