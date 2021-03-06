'use strict';

app.config(function($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'web/assurance/templates/default.html',
            controller: 'ClientListController'
        })
        .when('/form', {
            templateUrl: 'web/examples/templates/form.html',
            controller: 'FormController'
        })
        .when('/user/new', {
            templateUrl: 'web/examples/templates/new-user.html',
            controller: 'UserController'
        })
        .when('/client/new', {
            templateUrl: 'web/assurance/templates/new-client.html',
            controller: 'ClientController'
        })
        .when('/client/update/:id', {
            templateUrl: 'web/assurance/templates/update-client.html',
            controller: 'ClientUpdateController'
        })
        .when('/client/delete/:id', {
            templateUrl: 'web/assurance/templates/supp-client.html',
            controller: 'ClientDeleteController'
        })
        .when('/client/cars/:id', {
            templateUrl: 'web/assurance/templates/client-cars.html',
            controller: 'ClientCarsController'
        })
        .when('/client/assurance/:id', {
            templateUrl: 'web/assurance/templates/client-assurances.html',
            controller: 'ClientAssuranceController'
        })
        .when('/assurance/new/:id', {
            templateUrl: 'web/assurance/templates/new-assurance.html',
            controller: 'ClientAssuranceNewController'
        })
        .when('/pdf/:id', {
            templateUrl: 'web/examples/templates/pdf/new.html',
            controller: 'PdfNewController'
        })
        // .otherwise({
        //     redirectTo: '/error/404'
        // });
    ;
});
