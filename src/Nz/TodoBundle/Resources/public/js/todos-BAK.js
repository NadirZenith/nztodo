$(document).ready(function () {
    (function ($) {
        // **Todo class**: The atomic part of our Model. A model is basically a Javascript object, i.e. key-value pairs, with some helper functions to handle event triggering, persistence, etc.
        var Todo = Backbone.Model.extend({
            defaults: {
                id: null,
                task: 'task default'
            }
        });

        // **List class**: A collection of `Todo`s. Basically an array of Model objects with some helper functions.
        var TodoList = Backbone.Collection.extend({
            model: Todo
        });

        var TodoListView = Backbone.View.extend({
            el: $('#app'),
            events: {
                'click button#add': 'addTodo'
            },
            // `initialize()` now instantiates a Collection, and binds its `add` event to own method `appendTodo`. (Recall that Backbone doesn't offer a separate Controller for bindings...).
            initialize: function () {
                _.bindAll(this, 'render', 'addTodo', 'appendTodo'); // remember: every function that uses 'this' as the current object should be in here

                this.collection = new TodoList();
                this.collection.bind('add', this.appendTodo); // collection event binder

                this.counter = 0;
                this.render();
            },
            render: function () {
                // Save reference to `this` so it can be accessed from within the scope of the callback below
                var self = this;
                $(this.el).append("<button id='add'>Add todo</button>");
                $(this.el).append("<ul></ul>");
                _(this.collection.models).each(function (todo) { // in case collection is not empty
                    self.appendTodo(todo);
                }, this);
            },
            // `addTodo()` now deals solely with models/collections. View updates are delegated to the `add` event listener `appendTodo()` below.
            addTodo: function () {
                this.counter++;
                var todo = new Todo('this is default task');
                todo.set({
                    part2: todo.get('part2') + " " + this.counter // modify todo defaults
                });
                this.collection.add(todo); // add todo to collection; view is updated via event 'add'
            },
            // `appendTodo()` is triggered by the collection event `add`, and handles the visual update.
            appendTodo: function (todo) {
                $('ul', this.el).append("<li>" + todo.get('task') + "</li>");
            }
        });

        var todoListView = new TodoListView();
    })(jQuery);

})
        ;