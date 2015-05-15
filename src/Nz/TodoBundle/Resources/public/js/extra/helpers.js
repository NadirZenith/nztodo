var app = app || {};
app.helper = {};
app.helper.getQueryStringParam = function (param, url) {
    var url = url || window.location.href;
    param = param.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + param + "=([^&#]*)"),
            results = regex.exec(url);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


Backbone.View.prototype.close = function () {
    this.remove();
    this.unbind();
    if (this.onClose) {
        this.onClose();
    }
}