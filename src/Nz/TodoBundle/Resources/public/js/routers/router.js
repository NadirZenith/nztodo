/*global Backbone */
var app = app || {};

(function (RM) {
    'use strict';

    // Todo Router
    // ----------
    var TodoRouter = Backbone.Router.extend({
        routes: {
            '': 'defaultRoute',
            'todo/:id': 'viewTodo',
            'new-todo': 'newTodo',
            '*default': 'defaultRoute'
        },
        defaultRoute: function () {
            console.log('default');
            RM.show(new app.TodoAppView({}));
        },
        viewTodo: function (id) {
            console.log('view todo');
            RM.show(new app.TodoAppView({}));
        },
        newTodo: function () {
            console.log('new todo');
            RM.show(new app.TodoAppView({right: 'form'}));
        }

    });

    app.TodoRouter = new TodoRouter();
    Backbone.history.start();
})(RegionManager);
