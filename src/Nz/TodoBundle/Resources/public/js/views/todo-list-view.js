/*global Backbone, jQuery, _, ENTER_KEY */
var app = app || {};
(function ($) {
    'use strict';
    app.TodoListView = Backbone.View.extend({
        el: '#todo-list',
        initialize: function () {
            this.listenTo(app.todos, 'reset', this.addAll);
            app.todos.fetch({reset: true});
        },
        add: function (todo) {
            var view = new app.TodoView({model: todo});
            this.$el.prepend(view.render().el);
        },
        addOne: function (todo) {
            var view = new app.TodoView({model: todo});
            this.$el.append(view.render().el);
        },
        addAll: function () {
            app.todos.each(this.addOne, this);
        }
    });
})(jQuery);
