'use script';

var app = angular.module('app',
    ['ngRoute', 'ngSanitize', 'ngFileUpload'],
    function($httpProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
    }
);

app.controller('DefaultController', ['$http', function ($http) {
    console.log('DefaultController');

    this.default = $http({
        method: 'GET',
        url: '/app.php?route=default'
    })
    .then(function successCallback(response) {
        console.log('success');
        console.log(response.data);

    }, function errorCallback(response) {
        console.log('error');
        console.log(response.data);
    });
}]);


app.controller('ClientListController', ['$scope', '$http', function ($scope, $http) {
    

    console.log('ClientListController');

    $scope.clients = {};

    $http.get('/app.php?route=default')
        .then(function (response) {
            //console.log(response.data.clients[0].email);
            $scope.clients = response.data.clients;
        }, function (response) {
            console.log(response.status);
        });
}]);

app.controller('ClientController', ['$scope', '$http', function ($scope, $http) {
    console.log('ClientController');

    $scope.client = {};

    $scope.submit = function(client) {
        console.log(client.nom);

        if (client.nom !== "" && client.prenom !== "" && client.email !== "") {
            console.log('if');
            $http.post('/app.php?route=client_new', client)
                .then(function (response) {
                    console.log(response);
                    alert("Client ajouté avec succès !");
                        location.href="/";

                }, function (response) {
                    console.log('Error status: ' + response.status);
                });
        }
    };

}]);


app.controller('ClientUpdateController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
    
    console.log('ClientUpdateController');
    console.log($routeParams);

    $http.get('/app.php?route=client_update&id=' + $routeParams.id)
        .then(function (response) {
            $scope.client = response.data.client;
            console.log($scope.client.nom);
        }, function (response) {
            console.log(response.status);
        });

        $scope.submit = function (client) {
            console.log(client);
            $http.post('/app.php?route=client_update&id=' + $routeParams.id, client)
                .then(function (response) {
                    console.log(response);
                    if(response) {
                        alert("Client modifié avec succès !");
                        location.href="/";
                    }
                }, function (response) {
                    console.log('Error status: ' + response.status);
                });
        };

}]);

app.controller('ClientDeleteController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
    
    console.log('ClientDeleteController');
    console.log($routeParams);

    $http.get('/app.php?route=client_delete&id=' + $routeParams.id)
        .then(function (response) {
            $scope.client = response.data.client;
            console.log($scope.client.nom);
        }, function (response) {
            console.log(response.status);
        });

        $scope.submit = function (client) {
            console.log(client);
            $http.post('/app.php?route=client_delete&id=' + $routeParams.id, client)
                .then(function (response) {
                    console.log(response);
                    if(response)
                        alert("Client supprimé avec succès !");
                        location.href="/";
                }, function (response) {
                    console.log('Error status: ' + response.status);
                });
        };

}]);

app.controller('ClientCarsController', ['$scope', '$http','$routeParams', function ($scope, $http, $routeParams) {  
    console.log('ClientCarsController');
    console.log($routeParams);
    $scope.cars = {};

    $http.get('/app.php?route=client_cars&id=' + $routeParams.id)
        .then(function (response) {
            console.log(response.data);
            $scope.cars = response.data.cars;
            //console.log(cars);
        }, function (response) {
            console.log(response.status);
        });

}]);

app.controller('ClientAssuranceController', ['$scope', '$http','$routeParams', function ($scope, $http, $routeParams) {  
    console.log('ClientAssuranceController');
    console.log($routeParams);
    $scope.assurances = {};
    $scope.assurances2 = {};
    $scope.client = {};

    $http.get('/app.php?route=client_assurance_auto&id=' + $routeParams.id)
        .then(function (response) {
            console.log(response.data.assurances);
            $scope.assurances = response.data.assurances;
            //console.log(cars);
        }, function (response) {
            console.log(response.status);
        });

    $http.get('/app.php?route=client_assurance_autres&id=' + $routeParams.id)
        .then(function (response) {
            console.log(response.data.assurances2);
            $scope.assurances2 = response.data.assurances2;
            //console.log(cars);
        }, function (response) {
            console.log(response.status);
        });

    $http.get('/app.php?route=client_update&id=' + $routeParams.id)
        .then(function (response) {
            console.log(response.data);
            $scope.client = response.data.client;
            //console.log(cars);
        }, function (response) {
            console.log(response.status);
        });

}]);

app.controller('ClientAssuranceNewController', ['$scope', '$http','$routeParams', function ($scope, $http, $routeParams) {  
    console.log('ClientAssuranceNewController');
    console.log($routeParams);
    $scope.client = {};
    $scope.cars = {};
    $scope.assurtypes = ['auto','dc','vie'];

    $http.get('/app.php?route=client_update&id=' + $routeParams.id)
        .then(function (response) {
            console.log(response.data);
            $scope.client = response.data.client;
            //console.log(cars);
        }, function (response) {
            console.log(response.status);
        });

    $http.get('/app.php?route=client_cars&id=' + $routeParams.id)
        .then(function (response) {
            console.log(response.data);
            $scope.cars = response.data.cars;
            //console.log(cars);
        }, function (response) {
            console.log(response.status);
        });

}]);

/*app.controller('FormController', ['$scope', '$http', 'Upload', function ($scope, $http, Upload) {
    console.log('FormController');

    $scope.user = {
        name: 'test',
        email: 'test'
    };

    // upload on file select or drop
    $scope.submit = function (user) {
        Upload.upload({
            url: '/app.php?route=form',
            data: {file: user.file, user: user}
        })
        .then(function (response) {
            console.log(response);
            console.log('Success ' + response.config.data.user.avatar + 'uploaded. Response: ' + response.data);
        }, function (response) {
            console.log('Error status: ' + response.status);
        }, function (evt) {
            console.log(evt);
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            console.log('progress: ' + progressPercentage + '% ' + evt.config.data.user.avatar);
        });
    };
}]);

app.controller('PdfNewController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
    $scope.pdf = {};

    $http.get('/app.php?route=pdf_new&id=' + $routeParams.id)
        .then(function (response) {
            $scope.pdf = response.data;
        }, function (response) {
            console.log(response.status);
        });
}]);

app.controller('HouseShowController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
    $scope.house = {};

    $http.get('/app.php?route=house_show&id=' + $routeParams.id)
        .then(function (response) {
            $scope.house = response.data.house;
        }, function (response) {
            console.log(response.status);
        });
}]);

app.controller('HouseNewController', ['$scope', '$http', 'Upload', function ($scope, $http, Upload) {
    console.log('HouseNewController');

    $scope.house = {
        color: 'red',
        examples_entity_user: {
            name: 'test House',
            email: 'test@house.com'
        },
        examples_entity_car: {
            brand: "Renault"
        }
    };

    $scope.submit = function (house) {
        console.log(house);

        Upload.upload({
            url: '/app.php?route=house_new',
            data: {house: house}
        })
            .then(function (response) {
                console.log(response);
                console.log('Success ' + response.config.data.house.avatar + 'uploaded. Response: ' + response.data);
            }, function (response) {
                console.log('Error status: ' + response.status);
            }, function (evt) {
                console.log(evt);
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                console.log('progress: ' + progressPercentage + '% ' + evt.config.data.house.avatar);
            });


        //When no pictures are uploaded you can use this one

        // $http.post('/app.php?route=house_new', house)
        //     .then(function (response) {
        //         console.log('success');
        //         console.log(response);
        //     }, function (response) {
        //         console.log(response.status);
        //     });
    };
}]);

app.controller('UserShowController', ['$scope', '$http', '$routeParams', function ($scope, $http, $routeParams) {
    console.log('UserShowController');
    console.log($routeParams);

    $http.get('/app.php?route=user_show&id=' + $routeParams.id)
        .then(function (response) {
            $scope.user = response.data.user;
        }, function (response) {
            console.log(response.status);
        });
}]);

app.controller('UserController', ['$scope', '$http', 'Upload', function ($scope, $http, Upload) {
    console.log('UserController');

    $scope.user = {
        name: 'test Test',
        email: 'test@mail.com',
        avatar: ''
    };

    $scope.submit = function (user) {
        console.log(user.avatar);

        if (user.avatar === undefined || user.avatar === '') {
            console.log('if');
            $http.post('/app.php?route=user_new', user)
                .then(function (response) {
                    console.log(response);
                }, function (response) {
                    console.log('Error status: ' + response.status);
                });
        } else {
            console.log('else');

            Upload.upload({
                url: '/app.php?route=user_new',
                data: {user: user}
            })
                .then(function (response) {
                    console.log(response);
                    console.log('Success ' + response.config.data.user.avatar + 'uploaded. Response: ' + response.data);
                }, function (response) {
                    console.log('Error status: ' + response.status);
                }, function (evt) {
                    console.log(evt);
                    var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                    console.log('progress: ' + progressPercentage + '% ' + evt.config.data.user.avatar);
                });
        }
    };
}]);

app.controller('UserListController', ['$scope', '$http', function ($scope, $http) {
    $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

    console.log('UserListController');

    $scope.users = {};

    $http.get('/app.php?route=user_list')
        .then(function (response) {
            $scope.users = response.data.users;
        }, function (response) {
            console.log(response.status);
        });
}]);
*/