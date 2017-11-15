var app = angular.module("myApp", ["ngRoute"]);
app.config(function($routeProvider) {
    $routeProvider
    .when("frontend/", {
        templateUrl : "index.html"
    })
    .when("/frontend/new", {
        templateUrl : "frontend/quotation/new.html"
    })
});
