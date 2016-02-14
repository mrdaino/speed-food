/**
 * Created by Lorenzo Daneo.
 * mail to lorenzo.daneo@coolsholp.it
 */

var request = function(url){

    var pathRequest = "http://speed-food_back.local/base-request/";

    var api = "";

    switch (url){
        case "ristoranti": api = "getRistoranti"; break;
        case "prodotti": api = "getProdotti"; break;
        case "ingredienti": api = "getIngredienti"; break;
        default: api = ""; break;
    }

    return{
        get: function(){
            var response = function() {
                return $.ajax({
                    'type': 'GET',
                    'url': pathRequest + api,
                    'dataType': 'json'
                });
            };
            return response();
        },
        post: function(element){
            $.postJSON = function() {
                return jQuery.ajax({
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    'type': 'POST',
                    'url': pathRequest + api,
                    'data': JSON.stringify(element),
                    'dataType': 'json'
                });
            };
            return $.postJSON();
        }
    }

};