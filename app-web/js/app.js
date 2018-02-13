var App = function () {
    var self = this;
    var appHost = 'http://cl-tech.local/app-api/public/index.php';

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

    this.callRead = function(){
        $.ajax({
                type: 'POST',
                url: appHost+"/read",
                data: {'token':localStorage.getItem('token'), 'companyId': localStorage.getItem('companyId')},
                success: function(result){
                    console.log(result);
                }
         });
    }

    this.getEndpoints = function(){
        $.ajax({
            url: appHost+"/endpoints",
            success: function(result){
                $.each(result, function(i, item) {
                    $('#side-navigation').append(
                        '<li class="nav-item" data-endpoint="'+item.endpoint+'">'+
                        '<a class="nav-link active" href="#">'+
                        item.name+
                        '</a>'+
                        '</li>');
                });

            }
        });
    }
}

var app = new App();

$(document).ready(function () {
    app.saveInfo();
    app.getEndpoints();
    $("#sample-api").click(function(){
        app.callRead();
    });
});
