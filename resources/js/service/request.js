/**
 * Created by lorenzodaneo on 11/02/16.
 */

var request = function(){

    var pathRequest = "/speed-food/back/base-request/";

    return{
        get: function(api){
            var response = function() {
                return $.ajax({
                    'type': 'GET',
                    'url': pathRequest + api,
                    'dataType': 'json'
                });
            };
            return response();
        }
    }

};