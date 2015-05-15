/*global Backbone, jQuery, _, ENTER_KEY */
var app = app || {};
(function ($) {
    'use strict';
    app.TodoAppView = Backbone.View.extend({
        el: '#main',
        //form_template: _.template($('#todo-form-tpl').html()),
        todo_detail_tpl: _.template($('#todo-detail-tpl').html()),
        events: {
            'click #new-todo': 'newTodoClick',
            'submit #form-todo': 'saveTodo'
        },
        initialize: function (options) {
            options = options || {};
            /*this.$detailView = this.$('#detail-view');*/
            this.listView = new app.TodoListView();
            if (options.right && options.right == 'form') {
                this.showForm();
                console.log('start with form');
            } else {
                console.log('start with last');
            }

        },
        render: function () {
        },
        newTodoClick: function (e) {
            e.preventDefault();
            app.TodoRouter.navigate($(e.currentTarget).attr('href'));
            this.showForm();
        },
        showForm: function () {
            var formView = new app.TodoFormView();
            formView.render();

        },
        saveTodo: function (e) {
            e.preventDefault();
            var $form = $(e.currentTarget),
                    data = {};

            $.each($($form).serializeArray(), function (i, obj) {
                data[obj.name] = obj.value;
            });
            var todo = new app.Todo(data);
            this.listView.add(todo);
            todo.save({}, {
                success: function () {
                    //hits error 201 created
                },
                error: function (model, response) {
                    console.log(response);
                    if (201 == response.status) {
                        var url = response.getResponseHeader('Location');
                        var id = app.helper.getQueryStringParam('id', url);
                        model.set('id', id);
                    }
                }
            });
        }
    });
})(jQuery);
