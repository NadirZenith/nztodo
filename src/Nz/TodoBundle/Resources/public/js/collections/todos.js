/*global Backbone */
var app = app || {};

(function () {
    'use strict';

    var Todos = Backbone.Collection.extend({
        // Reference to this collection's model.
        model: app.Todo,
        url: 'http://nztodo.app.dev/app_dev.php/todos',
        parse: function (response) {
            return response.todos;
        }
    });

    // Create our global collection of **Todos**.
    app.todos = new Todos();
})();
