/**
 * Created by Lorenzo Daneo.
 * mail to lorenzo.daneo@coolsholp.it
 */

var app = angular.module('lunchModule',['ngRoute'])
    .config(['$routeProvider','$locationProvider',function ($routeProvider, $locationProvider) {

        var title = 'Uni Lunch';
        var separator = ' - ';

        //configure the routing rules here
        $routeProvider
            .when('/',{
                title: title + separator + 'Home',
                templateUrl: 'partials/home.html',
                controller: 'homeCtrl'
            })
            .when('/ristoranti',{
                title: title + separator + 'Ristoranti',
                templateUrl: 'partials/ristoranti.html',
                controller: 'ristorantiCtrl'
            })
            .when('/prenotazione/:userId',{
                title: title + separator + 'Prenotazione',
                templateUrl: 'partials/prenotazione.html',
                controller: 'prenotazioneCtrl'
            });

        // enable HTML5mode to disable hashbang urls
        $locationProvider.html5Mode(true);
    }])
    .run(['$rootScope', '$route', function($rootScope, $route) {
        $rootScope.$on('$routeChangeSuccess', function() {
            document.title = $route.current.title;
        });
    }]);