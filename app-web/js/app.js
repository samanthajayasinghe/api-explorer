var App = function () {
    var self = this;

    this.saveInfo = function () {
        var token = self.getUrlParam('token');
        var companyId = self.getUrlParam('companyId');

        if (typeof(token) != 'undefined') {
            localStorage.setItem('token', token);
        }
        if (typeof(companyId) != 'undefined') {
            localStorage.setItem('companyId', companyId);
        }
    }

    this.getUrlParam = function (name) {
        var results = new RegExp('[\?&]'+name+'=([^&#]*)').exec(window.location.href);
        if (results !== null) {
            return results[1];
        }
    }

    this.callRead = function(endpoint, data){
        $.ajax({
                type: 'POST',
                url: "http://cl-tech.local/app-api/public/index.php/read",
                data: {'token':localStorage.getItem('token'), 'companyId': localStorage.getItem('companyId')},
                success: function(result){
                    console.log(result);
                }
         });
    }
}

var app = new App();

$(document).ready(function () {
    app.saveInfo();

    $("button").click(function(){
        app.callRead('','');
    });
});
