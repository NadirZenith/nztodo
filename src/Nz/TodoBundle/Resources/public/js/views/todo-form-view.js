var app = app || {};

(function ($) {
    'use strict';

    app.TodoFormView = Backbone.View.extend({
        model: {},
        template: _.template($('#todo-form-tpl').html()),
        el: '#detail-view',
        // The DOM events specific to an item.
        events: {
            'click #cancel-creation': 'clear'
        },
        initialize: function () {
            /*this.listenTo(this.model, 'change', this.modelChanged);*/
        },
        render: function () {
            this.$el.html(this.template());
            /*this.$el.html(this.template(this.model.toJSON()));*/
            return this;
        },
        clear : function(){
            /*this.model.destroy();*/
            this.remove();
        }
    });

})(jQuery);
