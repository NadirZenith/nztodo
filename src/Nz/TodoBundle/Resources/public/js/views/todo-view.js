var app = app || {};

(function ($) {
    'use strict';

    app.TodoView = Backbone.View.extend({
        template: _.template($('#todo-tpl').html()),
        // The DOM events specific to an item.
        events: {
            'click .toggleCompleted': 'toggleCompleted',
            'click .todo-remove': 'removeTodo',
            'click .todo-view': 'view'
        },
        initialize: function () {
            this.listenTo(this.model, 'change', this.modelChanged);
        },
        modelChanged: function () {
            console.log('changed ' + this.model.get('id'));
        },
        render: function () {
            this.setElement(this.template(this.model.toJSON()));
            return this;
        },
        // Toggle the `"completed"` state of the model.
        toggleCompleted: function (e) {
            this.model.toggleCompleted();

            var $btn = $(e.currentTarget);
            if ($btn.hasClass('on')) {
                $btn.removeClass('on').addClass('off');
            } else if ($btn.hasClass('off')) {
                $btn.removeClass('off').addClass('on');
            }
        },
        removeTodo: function (e) {
            e.preventDefault();
            this.model.destroy();
            this.remove();

        },
        view: function (e) {
            /*e.preventDefault();*/
            /*console.log('view todo ', this);*/
            /*console.log(e);*/
        },
        // Remove the item, destroy the model from *localStorage* and delete its view.
        clear: function () {
            this.model.destroy();
        }
    });

})(jQuery);
