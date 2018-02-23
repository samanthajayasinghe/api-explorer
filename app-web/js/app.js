var App = function () {
    var self = this;
    var appHost = 'http://cl-tech.local/app-api/public/index.php';

    this.saveInfo = function () {
        var token = self.getUrlParam('token');
        var companyId = self.getUrlParam('companyId');

        if (typeof(token) != 'undefined') {
            localStorage.setItem('token', token);
            $("#app-connect").html('Disconnect');
        }
        if (typeof(companyId) != 'undefined') {
            localStorage.setItem('companyId', companyId);
        }
    },

        this.removeInfo = function () {
            if (typeof(localStorage.getItem('token') != 'undefined')) {
                localStorage.removeItem('token');
            }
            if (typeof(localStorage.getItem('companyId') != 'undefined')) {
                localStorage.removeItem('companyId');
            }
            $("#app-connect").html('Connect');
        },

        this.getUrlParam = function (name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (results !== null) {
                return results[1];
            }
        },

        this.requestApiData = function (endpoint) {
            var form = $('#api-request-box-form');
            form.validate();
            if (form.valid()) {
                $.ajax({
                    type: 'POST',
                    url: appHost + "/read",
                    data: {
                        'token': localStorage.getItem('token'),
                        'endpoint': endpoint,
                        'form-data': $('#api-request-box-form').serializeArray()
                    },
                    success: function (result) {
                        $('#api-response-box').show();
                        $('#response-body > pre').html(JSON.stringify(result.body, null, 2));
                        $('#response-header > pre').html(JSON.stringify(result.header, null, 2));
                        $('#response-endpoint > pre').html(result.endpont);
                        $('#response-statuscode').html(result.statusCode);
                        if (result.Error) {
                            $('#response-error > pre').html(JSON.stringify(result.Error, null, 2));
                            $('#response-error').show();
                            $('#response-error').prev().show();
                        } else {
                            $('#response-error').hide();
                            $('#response-error').prev().hide();
                        }
                    },
                    beforeSend: function () {
                        $("#loading").show();
                        $("#loading").focus();
                        $('#api-response-box').hide();
                    },
                    complete: function () {
                        $("#loading").hide();
                    },
                });
            }
        },

        this.getEndpoints = function () {
            $.ajax({
                url: appHost + "/endpoints",
                success: function (result) {
                    $.each(result, function (i, item) {
                        $('#side-navigation').append(
                            '<li class="nav-item" data-name="' + item.name + '" data-endpoint="' + item.endpoint + '" data-id="' + item.id + '" data-params="' + item.params + '" id="menu-item-' + item.id + '">' +
                            '<a class="nav-link active" href="javascript:app.showAPIForm(' + item.id + ')">'
                            + item.name +
                            '</a>' +
                            '</li>');
                    });
                    self.showAPIForm(1);
                }
            });
        },

        this.showAPIForm = function (id) {
            var item = $('#menu-item-' + id);
            var endpoint = item.data('endpoint');
            $('#request-end-point').html(endpoint);
            $('#api-request-box-input').html('');
            $('#request-name').html(item.data('name'));
            $.each(item.data('params').split(','), function (i, param) {
                var value = '';
                if (param == 'companyId') {
                    value = localStorage.getItem('companyId');
                }
                $('#api-request-box-input').append(
                    '<div class="form-group">' +
                    '<label>' + param + '</label>' +
                    '<input name="' + param + '" class="form-control"  placeholder="Enter ' + param + '" value="' + value + '" required>' +
                    '</div>'
                );
            });
            $('#button-request-api').attr('data-end-point', endpoint);
            $('#api-request-box').focus();
            $('#api-response-box').hide();
        }

    this.getConnectUrl = function () {
        return appHost + '/connect';
    }
}

var app = new App();

$(document).ready(function () {
    app.saveInfo();
    app.getEndpoints();
    $("#button-request-api").click(function () {
        app.requestApiData($(this).attr('data-end-point'));
    });
    $("#app-connect").click(function () {
        if ($(this).html() == 'Connect') {
            window.location.href = app.getConnectUrl();
        } else {
            app.removeInfo();
        }
    });

});
